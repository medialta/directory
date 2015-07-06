<?php

$checkboxField = [
    'sql'                     => "char(1) NOT NULL default ''",
    'inputType'               => 'checkbox'
];

$GLOBALS['TL_DCA']['tl_module']['palettes']['directoryList'] = '{title_legend},name,headline,type;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['directoryForm'] = '{title_legend},name,headline,type;{directory_form_settings},directory_allow_edit,directory_allow_delete,directory_logo_folder;';

$GLOBALS['TL_DCA']['tl_module']['fields']['directory_allow_edit'] = $checkboxField;
$GLOBALS['TL_DCA']['tl_module']['fields']['directory_allow_delete'] = $checkboxField;

$GLOBALS['TL_DCA']['tl_module']['fields']['directory_allow_edit']['label'] = &$GLOBALS['TL_LANG']['tl_module']['directory_allow_edit'];
$GLOBALS['TL_DCA']['tl_module']['fields']['directory_allow_delete']['label'] = &$GLOBALS['TL_LANG']['tl_module']['directory_allow_delete'];

$GLOBALS['TL_DCA']['tl_module']['fields']['directory_logo_folder'] = [
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['directory_logo_folder'],
    'inputType'               => 'fileTree',
    'eval'                    => ['files' => false, 'fieldType' => 'radio', 'mandatory' => true],
    'sql'                     => "binary(16) NULL"
];
