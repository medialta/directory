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
 * Namespace
 */
namespace Directory;


/**
 * Class ModuleDirectoryList
 *
 * @copyright  Medialta 2015
 * @author     Medialta
 * @package    Devtools
 */
class ModuleDirectoryList extends \Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_directory_list';


	/**
	 * Generate the module
	 */
	protected function compile()
	{
		$hl = (strlen($this->hl)) ? (int)substr($this->hl, 1) : 1;

		$this->Template->subhl = 'h' . ($hl + 1);
		$this->Template->subsubhl = 'h' . ($hl + 2);
		$this->Template->companies = \DirectoryCompanyModel::findAllPublished();
	}
}
