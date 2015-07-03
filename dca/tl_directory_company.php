<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package   Directory
 * @author    Medialta
 * @license   GNU/LGPL
 * @copyright Medialta 2015
 */


/**
 * Table tl_directory_company
 */
$GLOBALS['TL_DCA']['tl_directory_company'] = array
(
    // Config
    'config' => array
    (
        'dataContainer'               => 'Table',
        'enableVersioning'            => true,
        'switchToEdit'                => false,
        'closed'                      => false,
        'notEditable'                 => false,
        'notDeletable'                => false,
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary',
                'activity' => 'index'
            )
        )
    ),

    //List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 1,
            'flag'                    => 1,
            'panelLayout'             => 'sort,filter;search,limit',
            'fields'                  => array('corporate_name')
        ),
        'label' => array
        (
            'fields'                  => array('corporate_name'),
            'format'                  => '%s'
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'                => 'act=select',
                'class'               => 'header_edit_all',
                'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_directory_company']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.gif'
            ),
            'copy' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_directory_company']['copy'],
                'href'                => 'act=copy',
                'icon'                => 'copy.gif'
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_directory_company']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_directory_company']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback'     => array('tl_directory_company', 'toggleIcon')
			),
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_directory_company']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.gif'
            )
        )
    ),


    //Palettes
    'palettes' => array
    (
        '__selector__'                => array('public'),
        'default'                     => '{company_infos},name,corporate_name,job,creation_date,address,zipcode,city,phone,mobile,email,activity,ape_code,description,website,logo;{company_public},public;{company_published},published;'
    ),

    //Subpalettes
    'subpalettes' => array
    (
    	'public'                  => 'joining_reason'
	),

    //Fields
    'fields' => array
    (
        'id' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'member' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'name' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_directory_company']['name'],
            'search'                  => true,
			'inputType'               => 'text',
			'sql'                     => "varchar(255) NOT NULL default ''",
			'eval'                    => array('mandatory' => true, 'maxlength' => 255)
        ),
        'corporate_name' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_directory_company']['corporate_name'],
			'inputType'               => 'text',
			'sql'                     => "varchar(255) NOT NULL default ''",
			'eval'                    => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50')
        ),
        'job' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_directory_company']['job'],
			'inputType'               => 'text',
			'sql'                     => "varchar(255) NOT NULL default ''",
			'eval'                    => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50')
        ),
        'creation_date' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_directory_company']['creation_date'],
			'inputType'				  => 'text',
			'eval'                    => array('rgxp' => 'date', 'mandatory' => true, 'datepicker' => true, 'tl_class' => 'clr wizard'),
			'sql'                     => "int(10) NULL"
        ),
		'address' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_directory_company']['address'],
            'inputType'               => 'text',
            'sql'                     => "varchar(255) NOT NULL default ''",
            'eval'                    => array('mandatory' => true, 'maxlength' => 255)
        ),
        'zipcode' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_directory_company']['zipcode'],
            'search'                  => true,
            'inputType'               => 'text',
            'sql'                     => "varchar(5) NOT NULL default ''",
            'eval'                    => array('mandatory' => true, 'maxlength' => 5, 'rgxp' => 'digit', 'tl_class' => 'w50')
        ),
        'city' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_directory_company']['city'],
            'search'                  => true,
            'inputType'               => 'text',
            'sql'                     => "varchar(64) NOT NULL default ''",
            'eval'                    => array('mandatory' => true, 'maxlength' => 64, 'tl_class' => 'w50')
        ),
        'phone' => array
		(
            'label'                   => &$GLOBALS['TL_LANG']['tl_directory_company']['phone'],
            'inputType'				  => 'text',
            'sql'                     => "varchar(15) NOT NULL default ''",
            'eval'					  => array('mandatory' => true, 'maxlength' => 15, 'rgxp' => 'phone', 'tl_class' => 'w50')
        ),
        'mobile' => array
		(
            'label'                   => &$GLOBALS['TL_LANG']['tl_directory_company']['mobile'],
            'inputType'				  => 'text',
            'sql'                     => "varchar(15) NOT NULL default ''",
            'eval'					  => array('maxlength' => 15, 'rgxp' => 'phone', 'tl_class' => 'w50')
        ),
		'email' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_directory_company']['email'],
            'search'                  => true,
            'inputType'               => 'text',
            'sql'                     => "varchar(64) NOT NULL default ''",
            'eval'                    => array('mandatory' => true, 'maxlength' => 64, 'rgxp' => 'email', 'tl_class' => 'clr')
        ),
        'activity' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_directory_company']['activity'],
			'filter'                  => true,
			'inputType'               => 'select',
			'options'                 => DirectoryActivityModel::listing(),
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'eval'                    => array('mandatory' => true, 'includeBlankOption' => true, 'chosen' => true, 'tl_class' => 'w50')
        ),
        'ape_code' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_directory_company']['ape_code'],
			'filter'                  => true,
			'inputType'               => 'text',
			'sql'                     => "varchar(10) NOT NULL default ''",
			'eval'                    => array('mandatory' => true, 'maxlength' => 10, 'tl_class' => 'w50')
        ),
        'website' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_directory_company']['website'],
			'inputType'               => 'text',
			'sql'                     => "varchar(255) NOT NULL default ''",
			'eval'                    => array('maxlength' => 255, 'tl_class' => 'clr')
        ),
        'description' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_directory_company']['description'],
			'inputType'               => 'textarea',
			'sql'                     => "text null",
			'eval'                    => array()
        ),
        'logo' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_directory_company']['logo'],
			'inputType'               => 'fileTree',
			'eval'                    => array('filesOnly' => true, 'extensions' => Config::get('validImageTypes'), 'fieldType' => 'radio', 'mandatory' => true),
			'sql'                     => "binary(16) NULL"
        ),
        'public' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_directory_company']['public'],
			'filter'                  => true,
			'sql'                     => "char(1) NOT NULL default ''",
			'inputType'               => 'checkbox',
            'eval'                    => array('submitOnChange' => true)
        ),
        'joining_reason' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_directory_company']['joining_reason'],
			'inputType'               => 'textarea',
			'sql'                     => "text null",
			'eval'                    => array()
        ),
        'published' => array
		(
            'label'                   => &$GLOBALS['TL_LANG']['tl_directory_company']['published'],
			'filter'                  => true,
			'sql'                     => "char(1) NOT NULL default ''",
			'inputType'               => 'checkbox'
        )
    )
);

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @author Medialta
 */
class tl_directory_company extends Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

    /**
	 * Return the "toggle visibility" button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen(Input::get('tid')))
		{
			$this->toggleVisibility(Input::get('tid'), (Input::get('state') == 1), (@func_get_arg(12) ?: null));
			$this->redirect($this->getReferer());
		}

		$href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

		if (!$row['published'])
		{
			$icon = 'invisible.gif';
		}

		$objPage = $this->Database->prepare("SELECT * FROM tl_page WHERE id=?")
								  ->limit(1)
								  ->execute($row['pid']);

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ';
	}

    /**
	 * Disable/enable a user group
	 * @param integer
	 * @param boolean
	 * @param \DataContainer
	 */
	public function toggleVisibility($intId, $blnVisible, DataContainer $dc=null)
	{
		// Check permissions to edit
		Input::setGet('id', $intId);
		Input::setGet('act', 'toggle');

		$objVersions = new Versions('tl_directory_company', $intId);
		$objVersions->initialize();

		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_directory_company']['fields']['published']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_directory_company']['fields']['published']['save_callback'] as $callback)
			{
				if (is_array($callback))
				{
					$this->import($callback[0]);
					$blnVisible = $this->$callback[0]->$callback[1]($blnVisible, ($dc ?: $this));
				}
				elseif (is_callable($callback))
				{
					$blnVisible = $callback($blnVisible, ($dc ?: $this));
				}
			}
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_directory_company SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);

		$objVersions->create();
		$this->log('A new version of record "tl_directory_company.id='.$intId.'" has been created'.$this->getParentEntries('tl_directory_company', $intId), __METHOD__, TL_GENERAL);
	}
}
