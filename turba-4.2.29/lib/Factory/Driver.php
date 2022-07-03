<?php
/**
 * A Horde_Injector:: based Turba_Driver:: factory.
 *
 * PHP version 5
 *
 * @author   Michael Slusarz <slusarz@horde.org>
 * @category Horde
 * @license  http://www.horde.org/licenses/apl.html APL
 * @package  Turba
 */

/**
 * A Horde_Injector:: based Turba_Driver:: factory.
 *
 * Copyright 2010-2017 Horde LLC (http://www.horde.org/)
 *
 * See the enclosed file COPYING for license information (APL). If you
 * did not receive this file, see http://www.horde.org/licenses/apl.html.
 *
 * @author   Michael Slusarz <slusarz@horde.org>
 * @category Horde
 * @license  http://www.horde.org/licenses/apl.html APL
 * @package  Turba
 */
class Turba_Factory_Driver extends Horde_Core_Factory_Base
{
    /**
     * Instances.
     *
     * @var array
     */
    private $_instances = array();

    /**
     * Return the Turba_Driver:: instance.
     *
     * @param array $config      A config array describing the source.
     * @param string $srcName    The internal name of this source.
     * @param array $cfgSources  Override the global cfgSources configuration
     *                           with this array. Used when an admin needs
     *                           access to another user's sources like e.g.,
     *                           when calling removeUserData().
     *
     * @return Turba_Driver  The singleton instance.
     * @throws Turba_Exception
     */
    public function createFromConfig($config, $srcName = '', $cfgSources = array())
    {
        if (empty($cfgSources)) {
            $cfgSources = $GLOBALS['cfgSources'];
        }

        if (!is_array($config)) {
            throw new InvalidArgumentException('$config must be an array');
        }
        ksort($config);
        $key = md5(serialize($config));

        $source = !empty($config['params']['source'])
            ? $cfgSources[$config['params']['source']]
            : null;

        return $this->_create(
            $key,
            $config,
            $srcName,
            $source
        );
    }

    /**
     * Return the Turba_Driver:: instance.
     *
     * @param string $name       A string containing the internal name of
     *                           this source.
     *
     * @return Turba_Driver  The singleton instance.
     * @throws Turba_Exception
     */
    public function create($name)
    {
        global $cfgSources;

        if (!is_string($name)) {
            throw new InvalidArgumentException('$name must be a string');
        }
        if (empty($cfgSources[$name])) {
            throw new Turba_Exception(sprintf(_("The address book \"%s\" does not exist."), $name));
        }
        $srcConfig = $cfgSources[$name];

        $source = !empty($srcConfig['params']['source'])
            ? $cfgSources[$srcConfig['params']['source']]
            : null;
        return $this->_create(
            $name,
            $srcConfig,
            $name,
            $source
        );
    }

    private function _create($key, $srcConfig, $srcName, $cfgSources)
    {
        if (!isset($this->_instances[$key])) {
            if (!isset($srcConfig['type'])) {
                throw new Turba_Exception(
                    sprintf(
                        _("The address book \"%s\" does not exist."), $srcName
                    )
                );
            }
            $class = 'Turba_Driver_' . ucfirst(basename($srcConfig['type']));
            if (!class_exists($class)) {
                throw new Turba_Exception(
                    sprintf(_("Unable to load the definition of %s."), $class)
                );
            }

            if (empty($srcConfig['params'])) {
                $srcConfig['params'] = array();
            }

            switch ($class) {
            case 'Turba_Driver_Sql':
                try {
                    $srcConfig['params']['db'] =
                        empty($srcConfig['params']['sql'])
                            ? $this->_injector->getInstance('Horde_Db_Adapter')
                            : $this->_injector->getInstance(
                            'Horde_Core_Factory_Db'
                        )->create('turba', $srcConfig['params']['sql']);
                    $srcConfig['params']['charset'] =
                        isset($srcConfig['params']['sql']['charset'])
                            ? $srcConfig['params']['sql']['charset']
                            : 'UTF-8';
                } catch (Horde_Db_Exception $e) {
                    throw new Turba_Exception(
                        _("Server error when initializing database connection.")
                    );
                }
                break;

            case 'Turba_Driver_Kolab':
                $srcConfig['params']['storage'] =
                    $this->_injector->getInstance('Horde_Kolab_Storage');
                break;

            case 'Turba_Driver_Vbook':
                $srcConfig['params']['source'] = $cfgSources;
                break;
            }

            /* Make sure charset exists. */
            if (!isset($srcConfig['params']['charset'])) {
                $srcConfig['params']['charset'] = 'UTF-8';
            }

            $driver = new $class($srcName, $srcConfig['params']);

            // Title
            $driver->title = $srcConfig['title'];

            /* Store and translate the map at the Source level. */
            $driver->map = $srcConfig['map'];
            foreach ($driver->map as $mapkey => $val) {
                if (!is_array($val)) {
                    $driver->fields[$mapkey] = $val;
                }
            }

            /* Store tabs. */
            if (isset($srcConfig['tabs'])) {
                $driver->tabs = $srcConfig['tabs'];
            }

            /* Store remaining fields. */
            if (isset($srcConfig['strict'])) {
                $driver->strict = $srcConfig['strict'];
            }
            if (isset($srcConfig['approximate'])) {
                $driver->approximate = $srcConfig['approximate'];
            }
            if (isset($srcConfig['list_name_field'])) {
                $driver->listNameField = $srcConfig['list_name_field'];
            }
            if (isset($srcConfig['alternative_name'])) {
                $driver->alternativeName = $srcConfig['alternative_name'];
            }
            $this->_instances[$key] = $driver;
        }

        return $this->_instances[$key];
    }
}