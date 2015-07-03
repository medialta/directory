<?php

$GLOBALS['TL_DCA']['tl_module']['palettes']['directoryList'] = '{title_legend},name,headline,type;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['directoryForm'] = '{title_legend},name,headline,type;{directory_form_settings},directory_logo_folder;';

$GLOBALS['TL_DCA']['tl_module']['fields']['directory_logo_folder'] = [
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['directory_logo_folder'],
    'inputType'               => 'fileTree',
    'eval'                    => ['files' => false, 'fieldType' => 'radio', 'mandatory' => true],
    'sql'                     => "binary(16) NULL"
];
