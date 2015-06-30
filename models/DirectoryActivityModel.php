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
 * Class DirectoryActivityModel
 *
 * @copyright  Medialta 2015
 * @author     Medialta
 * @package    Devtools
 */
class DirectoryActivityModel extends \Model
{

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $strTable = 'tl_directory_activity';

	public static function listing()
	{
		$listing = [];
		$results = static::findAll(['order' => 'name']);

		while ($results->next())
		{
			$listing[$results->id] = $results->name;
		}

		return $listing;
	}
}
