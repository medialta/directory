<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @package Directory
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'Directory',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Modules
	'Directory\ModuleCompanyForm'      => 'system/modules/directory/modules/ModuleCompanyForm.php',
	'Directory\ModuleDirectoryList'    => 'system/modules/directory/modules/ModuleDirectoryList.php',

	// Models
	'Directory\DirectoryActivityModel' => 'system/modules/directory/models/DirectoryActivityModel.php',
	'Directory\DirectoryCompanyModel'  => 'system/modules/directory/models/DirectoryCompanyModel.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_company_form'   => 'system/modules/directory/templates',
	'mod_directory_list' => 'system/modules/directory/templates',
));
