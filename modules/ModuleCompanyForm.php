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
 * Class ModuleCompanyForm
 *
 * @copyright  Medialta 2015
 * @author     Medialta
 * @package    Devtools
 */
class ModuleCompanyForm extends \Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_company_form';


	/**
	 * Generate the module
	 */
	protected function compile()
	{
		$fields = [
			'name' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_name'],
				'inputType'               => 'text',
				'eval'                    => ['mandatory' => true, 'maxlength' => 255]
	        ],
	        'corporate_name' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_corporate_name'],
				'inputType'               => 'text',
				'eval'                    => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50']
	        ],
	        'job' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_job'],
				'inputType'               => 'text',
				'eval'                    => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50']
	        ],
	        'creation_date' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_creation_date'],
				'inputType'				  => 'text',
				'eval'                    => ['rgxp' => 'date', 'mandatory' => true, 'datepicker' => true, 'tl_class' => 'clr wizard']
	        ],
			'address' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_address'],
	            'inputType'               => 'text',
	            'eval'                    => ['mandatory' => true, 'maxlength' => 255]
	        ],
	        'zipcode' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_zipcode'],
	            'inputType'               => 'text',
	            'eval'                    => ['mandatory' => true, 'maxlength' => 5, 'rgxp' => 'digit', 'tl_class' => 'w50']
	        ],
	        'city' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_city'],
	            'inputType'               => 'text',
	            'eval'                    => ['mandatory' => true, 'maxlength' => 64, 'tl_class' => 'w50']
	        ],
	        'phone' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_phone'],
	            'inputType'				  => 'text',
	            'eval'					  => ['mandatory' => true, 'maxlength' => 15, 'rgxp' => 'phone', 'tl_class' => 'w50']
	        ],
	        'mobile' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_mobile'],
	            'inputType'				  => 'text',
	            'eval'					  => ['maxlength' => 15, 'rgxp' => 'phone', 'tl_class' => 'w50']
	        ],
			'email' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_email'],
	            'inputType'               => 'text',
	            'eval'                    => ['mandatory' => true, 'maxlength' => 64, 'rgxp' => 'email', 'tl_class' => 'clr']
	        ],
	        'activity' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_activity'],
				'inputType'               => 'select',
				'options'                 => \DirectoryActivityModel::listing(),
				'eval'                    => ['mandatory' => true, 'includeBlankOption' => true, 'chosen' => true, 'tl_class' => 'w50']
	        ],
	        'ape_code' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_ape_code'],
				'inputType'               => 'text',
				'eval'                    => ['mandatory' => true, 'maxlength' => 10, 'tl_class' => 'w50']
	        ],
	        'website' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_website'],
				'inputType'               => 'text',
				'eval'                    => ['maxlength' => 255, 'tl_class' => 'clr']
	        ],
	        'description' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_description'],
				'inputType'               => 'textarea'
	        ],
	        'logo' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_logo'],
				'inputType'               => 'fileTree',
				'eval'                    => ['filesOnly' => true, 'extensions' => \Config::get('validImageTypes'), 'fieldType' => 'radio', 'mandatory' => true]
	        ],
	        'public' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_public'],
				'inputType'               => 'radio',
	            'options'                 => ['1' => ucfirst($GLOBALS['TL_LANG']['MSC']['yes']), '' => ucfirst($GLOBALS['TL_LANG']['MSC']['no'])]
	        ],
	        'joining_reason' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_joining_reason'],
				'inputType'               => 'textarea'
	        ],
			'submit' => [
				'label'             => &$GLOBALS['TL_LANG']['MSC']['directory_form_submit_label'],
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
					$arrSet[$widgetName] = $widget->value;
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

		$this->Template->formId = $formId;
		$this->Template->form = $form->parse();
	}
}
