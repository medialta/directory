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
 * Table tl_directory_activity
 */
$GLOBALS['TL_DCA']['tl_directory_activity'] = array
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
                'id' => 'primary'
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
            'fields'                  => array('name')
        ),
        'label' => array
        (
            'fields'                  => array('name'),
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
                'label'               => &$GLOBALS['TL_LANG']['tl_directory_activity']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.gif'
            ),
            'copy' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_directory_activity']['copy'],
                'href'                => 'act=copy',
                'icon'                => 'copy.gif'
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_directory_activity']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_directory_activity']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.gif'
            )
        )
    ),


    //Palettes
    'palettes' => array
    (
        'default'                     => '{activity_infos},name;'
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
        'name' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_directory_activity']['name'],
            'search'                  => true,
			'inputType'               => 'text',
			'sql'                     => "varchar(255) NOT NULL default ''",
			'eval'                    => array('mandatory' => true, 'maxlength' => 255)
        )
	)
);
