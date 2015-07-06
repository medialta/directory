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
		$GLOBALS['TL_JAVASCRIPT'][] = '/system/modules/directory/assets/moment.js';
		$GLOBALS['TL_JAVASCRIPT'][] = '/system/modules/directory/assets/pikaday.js';
		$GLOBALS['TL_CSS'][] = '/system/modules/directory/assets/pikaday.css';

		$this->import('FrontendUser', 'User');
		$company = new \DirectoryCompanyModel();

		if (\Input::get('id'))
		{
			$company = \DirectoryCompanyModel::findByPk(\Input::get('id'));

			if ($this->directory_allow_delete && isset($_GET['delete']) && $company->member == $this->User->id)
			{
			    $company->delete();
				$company = new \DirectoryCompanyModel();
				$this->Template->delete = true;
			}
			else if (!$this->directory_allow_edit || (!$this->directory_allow_delete || !isset($_GET['delete'])) || $company->member != $this->User->id)
			{
				global $objPage;
				(new \PageError403())->generate($objPage->id);
			}
		}
		else
		{
			$firstSave = true;
		}

		$fields = [
			'name' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_name'],
				'inputType'               => 'text',
				'value'                   => $company->name,
				'eval'                    => ['mandatory' => true, 'maxlength' => 255]
	        ],
	        'corporate_name' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_corporate_name'],
				'inputType'               => 'text',
				'value'                   => $company->corporate_name,
				'eval'                    => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50']
	        ],
	        'job' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_job'],
				'inputType'               => 'text',
				'value'                   => $company->job,
				'eval'                    => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50']
	        ],
	        'creation_date' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_creation_date'],
				'inputType'				  => 'text',
				'value'                   => $company->creation_date,
				'eval'                    => ['rgxp' => 'date', 'mandatory' => true, 'datepicker' => true, 'tl_class' => 'clr wizard']
	        ],
			'address' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_address'],
	            'inputType'               => 'text',
				'value'                   => $company->address,
	            'eval'                    => ['mandatory' => true, 'maxlength' => 255]
	        ],
	        'zipcode' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_zipcode'],
	            'inputType'               => 'text',
				'value'                   => $company->zipcode,
	            'eval'                    => ['mandatory' => true, 'maxlength' => 5, 'rgxp' => 'digit', 'tl_class' => 'w50']
	        ],
	        'city' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_city'],
	            'inputType'               => 'text',
				'value'                   => $company->city,
	            'eval'                    => ['mandatory' => true, 'maxlength' => 64, 'tl_class' => 'w50']
	        ],
	        'phone' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_phone'],
	            'inputType'				  => 'text',
				'value'                   => $company->phone,
	            'eval'					  => ['mandatory' => true, 'maxlength' => 15, 'rgxp' => 'phone', 'tl_class' => 'w50']
	        ],
	        'mobile' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_mobile'],
	            'inputType'				  => 'text',
				'value'                   => $company->mobile,
	            'eval'					  => ['maxlength' => 15, 'rgxp' => 'phone', 'tl_class' => 'w50']
	        ],
			'email' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_email'],
	            'inputType'               => 'text',
				'value'                   => $company->email,
	            'eval'                    => ['mandatory' => true, 'maxlength' => 64, 'rgxp' => 'email', 'tl_class' => 'clr']
	        ],
	        'activity' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_activity'],
				'inputType'               => 'select',
				'value'                   => $company->activity_id,
				'options'                 => \DirectoryActivityModel::listing(),
				'eval'                    => ['mandatory' => true, 'includeBlankOption' => true, 'chosen' => true, 'tl_class' => 'w50']
	        ],
	        'ape_code' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_ape_code'],
				'inputType'               => 'text',
				'value'                   => $company->ape_code,
				'eval'                    => ['mandatory' => true, 'maxlength' => 10, 'tl_class' => 'w50']
	        ],
	        'website' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_website'],
				'inputType'               => 'text',
				'value'                   => $company->website,
				'eval'                    => ['maxlength' => 255, 'tl_class' => 'clr']
	        ],
	        'description' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_description'],
				'inputType'               => 'textarea',
				'value'                   => $company->description
	        ],
	        'logo' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_logo'],
				'inputType'               => 'upload',
				'value'                   => $company->logo_id,
				'eval'                    => ['extensions' => \Config::get('validImageTypes'), 'mandatory' => !$company->logo_id]
	        ],
	        'public' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_public'],
				'inputType'               => 'radio',
				'value'                   => $company->public,
	            'options'                 => ['1' => ucfirst($GLOBALS['TL_LANG']['MSC']['yes']), '' => ucfirst($GLOBALS['TL_LANG']['MSC']['no'])]
	        ],
	        'joining_reason' => [
	            'label'                   => &$GLOBALS['TL_LANG']['MSC']['directory_form_joining_reason'],
				'inputType'               => 'textarea',
				'value'                   => $company->joining_reason
	        ],
			'submit' => [
				'label'             => &$GLOBALS['TL_LANG']['MSC']['directory_form_submit_label'],
				'inputType'         => 'submit'
			]
		];

		$formId = 'form-edit-directory';
		$doNotSubmit = false;
		$isPost = \Input::post('FORM_SUBMIT') == $formId;
		$arrSet = [];
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
			// Save current record empty to get ID
			$arrSet['id'] = $company->save()->id;
			$arrSet['tstamp'] = time();
			$fileDestination = \FilesModel::findByPk($this->directory_logo_folder)->path . '/';

			foreach ($widgets as $widgetName => $widget)
			{
				if ($widget->rgxp == 'date')
				{
					$arrSet[$widgetName] = (new \Date($widget->value, \Date::getNumericDateFormat()))->tstamp;
				}
				else if ($widget->type == 'upload' && isset($_SESSION['FILES'][$widgetName]))
				{

					if (isset($_SESSION['FILES'][$widgetName]['uuid']))
					{
						$arrSet[$widgetName] = \String::uuidToBin($_SESSION['FILES'][$widgetName]['uuid']);
					}
					else
					{
						$extension = pathinfo($_SESSION['FILES'][$widgetName]['name'])['extension'];
						$newName = $widgetName . '_' . strtolower($company->id) . '.' . $extension;
						$_SESSION['FILES'][$widgetName]['name'] = $newName;

						move_uploaded_file($_SESSION['FILES'][$widgetName]['tmp_name'], TL_ROOT . '/' . $fileDestination . $newName);

						$file = new \FilesModel();
						$file->pid = $this->directory_logo_folder;
						$file->tstamp = time();
						$file->type = 'file';
						$file->path = $fileDestination . $newName;
						$file->extension = $extension;
						$file->found = 1;
						$file->name = $newName;
						$file->hash = (new \File($file->path))->hash;
						$file->save();

						$arrSet[$widgetName] = $file->id;
					}
				}
				else if ($widget->type != 'submit')
				{
					$arrSet[$widgetName] = $widget->value;
				}
			}

			if ($this->User->id)
			{
			    $arrSet['member'] = $this->User->id;
			}

			// Store the result
			try
			{
				$company->setRow($arrSet)->save();
				$this->Template->success = true;
			}
			catch (Exception $e)
			{
				if (!$firstSave)
				{
					$company->delete();
				}
			    echo $e->getMessage();
			}
		}

		$form = new \FrontendTemplate('form');
		$form->tableless = true;
		$form->method = 'post';
		$form->enctype = 'multipart/form-data';
		$form->formId = $formId;
		$form->formSubmit = $formId;
		$form->fields = $widgetsHtml;

		global $objPage;
		$this->Template->formId = $formId;
		$this->Template->form = $form->parse();
		$this->Template->company = $company;
		$this->Template->companies = \DirectoryCompanyModel::findAllByMember($this->User->id);
		$this->Template->editLink = '{{link_url::' . $objPage->id . '}}';

		$this->Template->subhl = (strlen($this->hl)) ? 'h' . ((int)substr($this->hl, 1) + 1) : 'h2';
		$this->Template->dateFormat = str_replace(['d', 'm', 'Y'], ['DD', 'MM', 'YYYY'], \Date::getNumericDateFormat());
	}
}
