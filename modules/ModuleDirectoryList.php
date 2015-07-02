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
		$fields = [
			'corporate_name' => [
				'label'             => &$GLOBALS['TL_LANG']['MSC']['directory_search_label'],
				'inputType'         => 'text'
			],
			'activity' => [
				'label'             => &$GLOBALS['TL_LANG']['MSC']['directory_search_activity_label'],
				'inputType'         => 'select',
				'options'           => \DirectoryActivityModel::listing(),
				'eval'              => ['includeBlankOption' => true]
			],
			'submit' => [
				'label'             => &$GLOBALS['TL_LANG']['MSC']['directory_search_submit_label'],
				'inputType'         => 'submit'
			]
		];

		$formId = 'form-search-directory';
		$doNotSubmit = false;
		$isPost = \Input::post('FORM_SUBMIT') == $formId;
		$arrSearch = [];
		$widgets = '';

		foreach ($fields as $name => $field)
		{
			$strClass = $GLOBALS['TL_FFL'][$field['inputType']];

			// Continue if the class is not defined
			if (!class_exists($strClass))
			{
				continue;
			}

			$objWidget = new $strClass($strClass::getAttributesFromDca($field, $name, $field['value'], '', '', null, true));

			// Validate the widget
			if ($isPost)
			{
				$objWidget->validate();

				if ($objWidget->hasErrors())
				{
					$doNotSubmit = true;
				}
			}

			$widgets[$name] = $objWidget;
			$widgetsHtml .= $objWidget->parse();
		}

		if (!$doNotSubmit && $isPost)
		{
			foreach ($widgets as $widgetName => $widget)
			{
				if (strlen($widget->value))
				{
					$arrSearch[$widgetName] = $widget->value;
				}
			}

			// Store the result
			$this->Template->success = true;
		}

		$form = new \FrontendTemplate('form');
		$form->tableless = true;
		$form->method = 'post';
		$form->formId = $formId;
		$form->formSubmit = $formId;
		$form->fields = $widgetsHtml;

		$hl = (strlen($this->hl)) ? (int)substr($this->hl, 1) : 1;

		$this->Template->subhl = 'h' . ($hl + 1);
		$this->Template->subsubhl = 'h' . ($hl + 2);
		$this->Template->companies = \DirectoryCompanyModel::findAllPublished($arrSearch);
		$this->Template->form = $form->parse();
	}
}
