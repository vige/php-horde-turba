<?php
/**
 * Read-only Turba directory driver for Facebook friends. Requires a Horde
 * application to be setup on Facebook and configured in horde/config/conf.php.
 *
 * Of limited utility since email addresses are not retrievable via the
 * Facebook API, unless the user allows the Horde application to access it -
 * and even then, it's a proxied email address.
 *
 * Copyright 2009-2017 Horde LLC (http://www.horde.org/)
 *
 * See the enclosed file LICENSE for license information (ASL).  If you did
 * did not receive this file, see http://www.horde.org/licenses/apache.
 *
 * @author   Michael J. Rubinsky <mrubinsk@horde.org>
 * @author   Jan Schneider <jan@horde.org>
 * @category Horde
 * @license  http://www.horde.org/licenses/apache ASL
 * @package  Turba
 */
class Turba_Driver_Facebook extends Turba_Driver
{
    /**
     * TODO
     *
     * @var Horde_Service_Facebook
     */
    protected $_facebook;

    /**
     * Cache
     *
     * @var Horde_Cache
     */
    protected $_cache;

    /**
     * Constructor
     *
     * @param string $name
     * @param array $params
     */
    public function __construct($name = '', array $params = array())
    {
        parent::__construct($name, $params);
        $this->_facebook = $params['storage'];
        unset($params['storage']);
        $this->_cache = $GLOBALS['injector']->getInstance('Horde_Cache');
    }

    /**
     * Checks if the current user has the requested permissions on this
     * source.
     *
     * @param integer $perm  The permission to check for.
     *
     * @return boolean  True if the user has permission, otherwise false.
     */
     public function hasPermission($perm)
     {
         switch ($perm) {
         case Horde_Perms::DELETE:
         case Horde_Perms::EDIT:
             return false;

         default:
             return true;
         }
     }

    /**
     * Searches with the given criteria and returns a
     * filtered list of results. If the criteria parameter is an empty array,
     * all records will be returned.
     *
     * @param array $criteria    Array containing the search criteria.
     * @param array $fields      List of fields to return.
     * @param array $blobFields  A list of fields that contain binary data.
     * @param boolean $count_only  Only return the count of matching items.
     * @return array  Hash containing the search results.
     * @throws Turba_Exception
     */
    protected function _search(array $criteria, array $fields, array $blobFields = array(), $count_only = false)
    {
        $cid = implode('|', array(
            'turba_fb_search',
            $GLOBALS['registry']->getAuth(),
            md5(json_encode($criteria) . '_' .
                implode('.' , $fields) . '_' .
                implode('.', $blobFields))
        ));

        if ($values = $this->_cache->get($cid, 3600)) {
            $values = json_decode($values, true);
            return $count_only ? count($values) : $values;
        }

        $results = array();
        foreach ($this->_getAddressBook($fields) as $key => $contact) {
            // If no search criteria, return full list.
            if (!count($criteria) ||
                $this->_criteriaFound($criteria, $contact)) {
                $results[$key] = $contact;
            }
        }
        $this->_cache->set($cid, json_encode($results));

        return $count_only ? count($results) : $results;
    }

    /**
     */
    protected function _criteriaFound($criteria, $contact, $and = false)
    {
        foreach ($criteria as $key => $val) {
            switch (strval($key)) {
            case 'AND':
                return count($val)
                    ? $this->_criteriaFound($val, $contact, true)
                    : false;

            case 'OR':
                return $this->_criteriaFound($val, $contact, false);

            default:
                if (!isset($val['field'])) {
                    if ($this->_criteriaFound($val, $contact)) {
                       if (!$and) {
                           return true;
                       }
                    } elseif ($and) {
                        return false;
                    }
                } elseif (isset($contact[$val['field']])) {
                    switch ($val['op']) {
                    case 'LIKE':
                        if (stristr($contact[$val['field']], $val['test']) === false) {
                            if ($and) {
                                return false;
                            }
                        } elseif (!$and) {
                            return true;
                        }
                        break;
                    }
                }
                break;
            }
        }

        return $and;
    }

    /**
     * Reads the given data from the address book and returns the results.
     *
     * @param string $key        The primary key field to use.
     * @param mixed $ids         The ids of the contacts to load.
     * @param string $owner      Only return contacts owned by this user.
     * @param array $fields      List of fields to return.
     * @param array $blobFields  Array of fields containing binary data.
     * @param array $dateFields  Array of fields containing date data.
     *                           @since 4.2.0
     *
     * @return array  Hash containing the search results.
     * @throws Turba_Exception
     */
    protected function _read($key, $ids, $owner, array $fields,
                             array $blobFields = array(),
                             array $dateFields = array())
    {
        return $this->_getEntry($ids, $fields);
    }

    /**
     * TODO
     */
    protected function _getEntry(array $keys, array $fields)
    {
        $key = 'turba_fb_getEntry|' . $GLOBALS['registry']->getAuth() . '|' . md5(implode('.', $keys) . '|' . implode('.', $fields));
        if ($values = $this->_cache->get($key, 3600)) {
            $values = json_decode($values, true);
            return $values;
        }
        $cleanfields = implode(', ', $this->_prepareFields($fields));
        $fql = 'SELECT ' . $cleanfields . ' FROM user WHERE uid IN (' . implode(', ', $keys) . ')';
        try {
            $results = array($this->_fqlToTurba($fields, current($this->_facebook->fql->run($fql))));
            $this->_cache->set($key, json_encode($results));
            return $results;
        } catch (Horde_Service_Facebook_Exception $e) {
            Horde::log($e, 'ERR');
            throw new Turba_Exception($e);
        }
    }

    /**
     * TODO
     */
    protected function _getAddressBook(array $fields = array())
    {
        $key = 'turba_fb_getAddressBook|' . $GLOBALS['registry']->getAuth() . '|' . md5(implode('.', $fields));
        if ($values = $this->_cache->get($key, 3600)) {
            return json_decode($values, true);
        }
        $cleanfields = implode(', ', $this->_prepareFields($fields));
        try {
            $fql = 'SELECT ' . $cleanfields . ' FROM user WHERE uid IN ('
                . 'SELECT uid2 FROM friend WHERE uid1=' . $this->_facebook->auth->getLoggedInUser() . ')';
            $results = $this->_facebook->fql->run($fql);
        } catch (Horde_Service_Facebook_Exception $e) {
            Horde::log($e, 'ERR');
            if ($e->getCode() == Horde_Service_Facebook_ErrorCodes::API_EC_PARAM_SESSION_KEY) {
                throw new Turba_Exception(_("You are not connected to Facebook. Create a Facebook connection in the Global Preferences."));
            }
            throw new Turba_Exception($e);
        }

        // Now pull out the results that are arrays
        $addressbook = array();
        foreach ($results as &$result) {
            $addressbook[$result['uid']] = $this->_fqlToTurba($fields, $result);
        }
        $this->_cache->set($key, json_encode($addressbook));

        return $addressbook;
    }

    protected function _fqlToTurba($fields, $result)
    {
        //$remove = array();
        foreach ($fields as $field) {
            if (strpos($field, '.') !== false) {
                $key = substr($field, 0, strpos($field, '.'));
                $subfield = substr($field, strpos($field, '.') + 1);
                $result[$field] = $result[$key][$subfield];
            }
        }
        if (!empty($result['birthday_date'])) {
            // Make sure the birthdate is in a standard format that
            // listDateObjects will understand.
            $bday = new Horde_Date($result['birthday_date']);
            $result['birthday_date'] = $bday->format('Y-m-d');
        }

        return $result;
    }

    /**
     * Parse out a fields array for use in a FB FQL query.
     *
     * @param array $fields  The fields, as configured in backends.php
     *
     *
     */
    protected function _prepareFields($fields)
    {
        return array_map(array($this, '_prepareCallback'), $fields);
    }

    static public function _prepareCallback($field)
    {
        if (strpos($field, '.') === false) {
            return $field;
        }
        return substr($field, 0, strpos($field, '.'));
    }
}
