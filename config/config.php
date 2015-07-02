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

// Backend Modules
$directoryModules = array
(
	'tl_directory_company' => array
	(
		'tables'     => array('tl_directory_company'),
		'icon'       => 'system/modules/directory/assets/company.png',
	),
	'tl_directory_activity' => array
	(
		'tables'     => array('tl_directory_activity'),
		'icon'       => 'system/modules/directory/assets/activity.png',
	)
);

$newBeMod = array();
$first = true;

foreach ($GLOBALS['BE_MOD'] as $key => $modules)
{
	$newBeMod[$key] = $modules;

	if ($first)
	{
		$newBeMod['directory'] = $directoryModules;
		$first = false;
	}
}

$GLOBALS['BE_MOD'] = $newBeMod;
unset($newBeMod);

// Frontend Modules
$GLOBALS['FE_MOD']['directory'] = array
(
	'directoryList'   => 'ModuleDirectoryList',
	'directoryForm'   => 'ModuleCompanyForm'
);
