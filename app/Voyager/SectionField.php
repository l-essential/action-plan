<?php

namespace App\Voyager;

use TCG\Voyager\FormFields\AbstractHandler;

class SectionField extends AbstractHandler
{
    protected $codename = 'section_field';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('vendor/voyager/formfields.section_field', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }

}