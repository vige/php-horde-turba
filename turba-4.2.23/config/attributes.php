<?php
/**
 * Turba Attributes File.
 *
 * This file contains examples of attributes that Turba understands, and their
 * types.
 *
 * IMPORTANT: DO NOT EDIT THIS FILE!
 * Local overrides MUST be placed in attributes.local.php or attributes.d/.
 * If the 'vhosts' setting has been enabled in Horde's configuration, you can
 * use attributes-servername.php.
 *
 * The syntax of this array is as follows:
 * <pre>
 * label - The text that the user will see attached to this field.
 * type - One of the following:
 *   - spacer            - header
 *   - description       - html
 *   - number            - int
 *   - intlist           - text
 *   - longtext          - countedtext
 *   - address           - file
 *   - boolean           - link
 *   - email             - emailconfirm
 *   - password          - passwordconfirm
 *   - enum              - multienum
 *   - radio             - set
 *   - date              - time
 *   - monthyear         - monthdayyear
 *   - colorpicker       - sorter
 *   - creditcard        - invalid
 *   - stringlist        - addresslink
 * required - Boolean whether this field is mandatory.
 * readonly - Boolean whether this field is editable.
 * desc - Any help text attached to this field.
 * default - The default value for this field.
 * time_object_label - The text to describe the time object category.
 *                     Only valid for monthdayyear types and removing this
 *                     from a monthdayyear type will hide it from the
 *                     listTimeObjects api.
 * params - Any other parameters that need to be passed to the
 *          field. For a documentation of available field
 *          parameters see: http://wiki.horde.org/Doc/Dev/FormTypes.
 * </pre>
 */

/* Personal stuff. */
$attributes['name'] = array(
    'label' => _("Name"),
    'type' => 'text',
    'required' => true,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['firstname'] = array(
    'label' => _("First Name"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['lastname'] = array(
    'label' => _("Last Name"),
    'type' => 'text',
    'required' => true,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['middlenames'] = array(
    'label' => _("Middle Names"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['namePrefix'] = array(
    'label' => _("Name Prefixes"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 32, 'maxlength' => 32)
);
$attributes['nameSuffix'] = array(
    'label' => _("Name Suffixes"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 32, 'maxlength' => 32)
);
$attributes['alias'] = array(
    'label' => _("Alias"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 32)
);
$attributes['nickname'] = array(
    'label' => _("Nickname"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 32, 'maxlength' => 32)
);
$attributes['yomifirstname'] = array(
    'label' => _("Phonetic First Name"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['yomilastname'] = array(
    'label' => _("Phonetic Last Name"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['birthday'] = array(
    'label' => _("Birthday"),
    'type' => 'monthdayyear',
    'required' => false,
    'params' => array('start_year' => 1900, 'end_year' => null, 'picker' => true, 'format_in' => '%Y-%m-%d', 'format_out' => $GLOBALS['prefs']->getValue('date_format')),
    'time_object_label' => _("Birthdays"),
);
$attributes['anniversary'] = array(
    'label' => _("Anniversary"),
    'type' => 'monthdayyear',
    'params' => array('start_year' => 1900, 'end_year' => null, 'picker' => true, 'format_in' => '%Y-%m-%d', 'format_out' => $GLOBALS['prefs']->getValue('date_format')),
    'required' => false,
    'time_object_label' => _("Anniversaries"),
);
$attributes['spouse'] = array(
    'label' => _("Spouse"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['children'] = array(
    'label' => _("Children"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['photo'] = array(
    'label' => _("Photo"),
    'type' => 'image',
    'required' => false,
    'params' => array('show_upload' => true, 'show_keeporig' => true, 'max_filesize'  => null),
);
$attributes['phototype'] = array(
    'label' => _("Photo MIME Type"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);

/* Locations, addresses. */
$attributes['homeAddress'] = array(
    'label' => _("Home Address"),
    'type' => 'address',
    'required' => false,
    'params' => array('rows' => 3, 'cols' => 40)
);
$attributes['homeStreet'] = array(
    'label' => _("Home Street Address"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['homePOBox'] = array(
    'label' => _("Home Post Office Box"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 10, 'maxlength' => 10)
);
$attributes['homeCity'] = array(
    'label' => _("Home City"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['homeProvince'] = array(
    'label' => _("Home State/Province"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['homePostalCode'] = array(
    'label' => _("Home Postal Code"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 10, 'maxlength' => 10)
);
$attributes['homeCountry'] = array(
    'label' => _("Home Country"),
    'type' => 'country',
    'required' => false,
    'params' => array('prompt' => true)
);
$attributes['homeCountryFree'] = array(
    'label' => _("Home Country"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['workAddress'] = array(
    'label' => _("Work Address"),
    'type' => 'address',
    'required' => false,
    'params' => array('rows' => 3, 'cols' => 40)
);
$attributes['workStreet'] = array(
    'label' => _("Work Street Address"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['workPOBox'] = array(
    'label' => _("Work Post Office Box"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 10, 'maxlength' => 10)
);
$attributes['workCity'] = array(
    'label' => _("Work City"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['workProvince'] = array(
    'label' => _("Work State/Province"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['workPostalCode'] = array(
    'label' => _("Work Postal Code"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 10, 'maxlength' => 10)
);
$attributes['workCountry'] = array(
    'label' => _("Work Country"),
    'type' => 'country',
    'required' => false,
    'params' => array('prompt' => true)
);
$attributes['workCountryFree'] = array(
    'label' => _("Work Country"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['companyAddress'] = array(
    'label' => _("Company Address"),
    'type' => 'address',
    'required' => false,
    'params' => array('rows' => 3, 'cols' => 40)
);
$attributes['otherAddress'] = array(
    'label' => _("Other Address"),
    'type' => 'address',
    'required' => false,
    'params' => array('rows' => 3, 'cols' => 40)
);
$attributes['otherStreet'] = array(
    'label' => _("Other Street Address"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['otherCity'] = array(
    'label' => _("Other City"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['otherProvince'] = array(
    'label' => _("Other State/Province"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['otherPostalCode'] = array(
    'label' => _("Other Postal Code"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 10, 'maxlength' => 10)
);
$attributes['otherCountry'] = array(
    'label' => _("Other Country"),
    'type' => 'country',
    'required' => false,
    'params' => array('prompt' => true)
);
$attributes['otherCountryFree'] = array(
    'label' => _("Other Country"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['otherPOBox'] = array(
    'label' => _("Other Post Office Box"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 10, 'maxlength' => 10)
);
$attributes['timezone'] = array(
    'label' => _("Time Zone"),
    'type' => 'enum',
    'params' => array('values' => Horde_Nls::getTimezones(), 'prompt' => true),
    'required' => false
);

/* Communication. */
$attributes['email'] = array(
    'label' => _("Email"),
    'type' => 'email',
    'required' => false,
    'params' => array('allow_multi' => false, 'strip_domain' => false, 'link_compose' => true, 'link_name' => null, 'delimiters' => ',', 'size' => null)
);
$attributes['emails'] = array(
    'label' => _("Emails"),
    'type' => 'email',
    'required' => false,
    'params' => array('allow_multi' => true, 'strip_domain' => false, 'link_compose' => true, 'link_name' => null, 'delimiters' => ',', 'size' => null)
);
$attributes['homePhone'] = array(
    'label' => _("Home Phone"),
    'type' => 'phone',
    'required' => false,
    'params' => array('size' => 15)
);
$attributes['homePhone2'] = array(
    'label' => _("Home Phone"),
    'type' => 'phone',
    'required' => false,
    'params' => array('size' => 15)
);
$attributes['workPhone'] = array(
    'label' => _("Work Phone"),
    'type' => 'phone',
    'required' => false,
    'params' => array('size' => 15)
);
$attributes['workPhone2'] = array(
    'label' => _("Work Phone"),
    'type' => 'phone',
    'required' => false,
    'params' => array('size' => 15)
);
$attributes['assistPhone'] = array(
    'label' => _("Assistant Phone"),
    'type' => 'phone',
    'required' => false,
    'params' => array('size' => 15)
);
$attributes['companyPhone'] = array(
    'label' => _("Company Phone"),
    'type' => 'phone',
    'required' => false,
    'params' => array('size' => 15)
);
$attributes['cellPhone'] = array(
    'label' => _("Mobile Phone"),
    'type' => 'cellphone',
    'required' => false
);
$attributes['carPhone'] = array(
    'label' => _("Car Phone"),
    'type' => 'phone',
    'required' => false,
    'params' => array('size' => 15)
);
$attributes['radioPhone'] = array(
    'label' => _("Radio Phone"),
    'type' => 'phone',
    'required' => false,
    'params' => array('size' => 15)
);
$attributes['fax'] = array(
    'label' => _("Fax"),
    'type' => 'phone',
    'required' => false,
    'params' => array('size' => 15)
);
$attributes['homeFax'] = array(
    'label' => _("Home Fax"),
    'type' => 'phone',
    'required' => false,
    'params' => array('size' => 15)
);
$attributes['pager'] = array(
    'label' => _("Pager"),
    'type' => 'phone',
    'required' => false,
    'params' => array('size' => 15)
);
$attributes['imaddress'] = array(
    'label' => _("Instant Messenger"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['imaddress2'] = array(
    'label' => _("Instant Messenger"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['imaddress3'] = array(
    'label' => _("Instant Messenger"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);

/* Job, company, organization. */
$attributes['title'] = array(
    'label' => _("Job Title"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['role'] = array(
    'label' => _("Occupation"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['businessCategory'] = array(
    'label' => _("Business Category"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['company'] = array(
    'label' => _("Company"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['department'] = array(
    'label' => _("Department"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['office'] = array(
    'label' => _("Office"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['logo'] = array(
    'label' => _("Logo"),
    'type' => 'image',
    'required' => false,
    'params' => array('show_upload' => true, 'show_keeporig' => true, 'max_filesize'  => null),
);
$attributes['logotype'] = array(
    'label' => _("Logo MIME Type"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);

/* Other */
$attributes['notes'] = array(
    'label' => _("Notes"),
    'type' => 'longtext',
    'required' => false,
    'params' => array('rows' => 3, 'cols' => 40)
);
$attributes['website'] = array(
    'label' => _("Website URL"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['freebusyUrl'] = array(
    'label' => _("Freebusy URL"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
if (!empty($GLOBALS['conf']['gnupg']['path'])) {
    $attributes['pgpPublicKey'] = array(
        'label' => _("PGP Public Key"),
        'type' => 'pgp',
        'required' => false,
        'params' => array('gpg' => $GLOBALS['conf']['gnupg']['path'], 'temp_dir' => Horde::getTempDir(), 'rows' => 3, 'cols' => 40)
    );
} else {
    $attributes['pgpPublicKey'] = array(
        'label' => _("PGP Public Key"),
        'type' => 'longtext',
        'required' => false,
        'params' => array('rows' => 3, 'cols' => 40)
    );
}
$attributes['smimePublicKey'] = array(
    'label' => _("S/MIME Public Certificate"),
    'type' => 'smime',
    'required' => false,
    'params' => array('temp_dir' => Horde::getTempDir(), 'rows' => 3, 'cols' => 40)
);
$attributes['category'] = array(
    'label' => _("Category"),
    'type' => 'category',
    'params' => array(),
    'required' => false
);

/* Additional attributes supported by Kolab */
$attributes['kolabHomeServer'] = array(
    'label' => _("Kolab Home Server"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['initials'] = array(
    'label' => _("Initials"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['manager'] = array(
    'label' => _("Manager"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['assistant'] = array(
    'label' => _("Assistant"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['gender'] = array(
    'label' => _("Gender"),
    'type' => 'enum',
    'required' => false,
    'params' => array('values' => array('male' => _("male"), 'female' => _("female")), 'prompt' => true),
);
$attributes['language'] = array(
    'label' => _("Language"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['latitude'] = array(
    'label' => _("Latitude"),
    'type' => 'number',
    'required' => false,
);
$attributes['longitude'] = array(
    'label' => _("Longitude"),
    'type' => 'number',
    'required' => false,
);

/* Additional attributes supported by some SyncML clients */
$attributes['workEmail'] = array(
    'label' => _("Work Email"),
    'type' => 'email',
    'required' => false,
    'params' => array('allow_multi' => false, 'strip_domain' => false, 'link_compose' => true, 'link_name' => null, 'delimiters' => ',', 'size' => null)
);
$attributes['homeEmail'] = array(
    'label' => _("Home Email"),
    'type' => 'email',
    'required' => false,
    'params' => array('allow_multi' => false, 'strip_domain' => false, 'link_compose' => true, 'link_name' => null, 'delimiters' => ',', 'size' => null)
);
$attributes['phone'] = array(
    'label' => _("Common Phone"),
    'type' => 'phone',
    'required' => false,
    'params' => array('size' => 15)
);
$attributes['workFax'] = array(
    'label' => _("Work Fax"),
    'type' => 'phone',
    'required' => false,
    'params' => array('size' => 15)
);
$attributes['workCellPhone'] = array(
    'label' => _("Work Mobile Phone"),
    'type' => 'cellphone',
    'required' => false
);
$attributes['homeCellPhone'] = array(
    'label' => _("Home Mobile Phone"),
    'type' => 'cellphone',
    'required' => false
);
$attributes['videoCall'] = array(
    'label' => _("Common Video Call"),
    'type' => 'phone',
    'required' => false,
    'params' => array('size' => 15)
);
$attributes['workVideoCall'] = array(
    'label' => _("Work Video Call"),
    'type' => 'phone',
    'required' => false,
    'params' => array('size' => 15)
);
$attributes['homeVideoCall'] = array(
    'label' => _("Home Video Call"),
    'type' => 'phone',
    'required' => false,
    'params' => array('size' => 15)
);
$attributes['voip'] = array(
    'label' => _("VoIP"),
    'type' => 'phone',
    'required' => false,
    'params' => array('size' => 15)
);
$attributes['sip'] = array(
    'label' => _("SIP"),
    'type' => 'email',
    'required' => false,
    'params' => array('allow_multi' => true, 'strip_domain' => false, 'link_compose' => true, 'link_name' => null, 'delimiters' => ',', 'size' => null)
);
$attributes['ptt'] = array(
    'label' => _("PTT"),
    'type' => 'phone',
    'required' => false,
    'params' => array('size' => 15)
);
$attributes['commonExtended'] = array(
    'label' => _("Common Address Extended"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['commonStreet'] = array(
    'label' => _("Common Street"),
    'type' => 'address',
    'required' => false,
    'params' => array('rows' => 3, 'cols' => 40)
);
$attributes['commonPOBox'] = array(
    'label' => _("Common Post Office Box"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 10, 'maxlength' => 10)
);
$attributes['commonCity'] = array(
    'label' => _("Common City"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['commonProvince'] = array(
    'label' => _("Common State/Province"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['commonPostalCode'] = array(
    'label' => _("Common Postal Code"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 10, 'maxlength' => 10)
);
$attributes['commonCountry'] = array(
    'label' => _("Common Country"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['commonCountryFree'] = array(
    'label' => _("Common Country"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['workWebsite'] = array(
    'label' => _("Work Website URL"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['workExtended'] = array(
    'label' => _("Work Address Extended"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['workLatitude'] = array(
    'label' => _("Work Latitude"),
    'type' => 'number',
    'required' => false,
);
$attributes['workLongitude'] = array(
    'label' => _("Work Longitude"),
    'type' => 'number',
    'required' => false,
);
$attributes['homeWebsite'] = array(
    'label' => _("Home Website URL"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['homeExtended'] = array(
    'label' => _("Home Address Extended"),
    'type' => 'text',
    'required' => false,
    'params' => array('regex' => '', 'size' => 40, 'maxlength' => 255)
);
$attributes['homeLatitude'] = array(
    'label' => _("Home Latitude"),
    'type' => 'number',
    'required' => false,
);
$attributes['homeLongitude'] = array(
    'label' => _("Home Longitude"),
    'type' => 'number',
    'required' => false,
);
$attributes['__tags'] = array(
    'label' => _("Tags"),
    'type' => 'Turba:TurbaTags',
    'required' => false,
);
