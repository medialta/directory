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
 * Class DirectoryCompanyModel
 *
 * @copyright  Medialta 2015
 * @author     Medialta
 * @package    Devtools
 */
class DirectoryCompanyModel extends \Model
{

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $strTable = 'tl_directory_company';

	public function __get($var)
	{
		switch ($var) {
			case 'creation_date':
				return (new \Date($this->arrData['creation_date']))->date;
				break;

			case 'activity':
				return \DirectoryActivityModel::findByPk($this->arrData['activity'])->name;
				break;

			case 'logo':
				return \FilesModel::findByPk($this->arrData['logo'])->path;
				break;

			case 'unformattedPhone':
				return self::unformatPhone($this->arrData['phone']);
				break;

			case 'unformattedMobile':
				return self::unformatPhone($this->arrData['mobile']);
				break;

			default:
				return parent::__get($var);
				break;
		}
	}

	public static function findAllPublished($arrSearch = [])
	{
		$db = \Database::getInstance();

		$query = 'SELECT * FROM ' . self::$strTable . ' WHERE published = 1 AND public = 1';
		$params = [];

		if (is_array($arrSearch) && !empty($arrSearch))
		{
		    foreach ($arrSearch as $column => $value)
		    {
		        $query .= ' AND ' . $column . ' LIKE ?';
				$params[] = '%' . $value . '%';
		    }
		}

		$query .= ';';

		return $db->prepare($query)->execute($params);
	}

	protected static function unformatPhone($phone)
	{
		if ($phone[0] == '0')
		{
			$phone = '+33' . substr($phone, 1);
		}

		return str_replace(' ', '', $phone);
	}
}
