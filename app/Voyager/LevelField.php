<?php

namespace App\Voyager;

use TCG\Voyager\FormFields\AbstractHandler;

class LevelField extends AbstractHandler
{
    protected $codename = 'level_field';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('vendor/voyager/formfields.level_field', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }

}