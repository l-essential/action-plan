<?php

namespace App\Voyager;

use TCG\Voyager\FormFields\AbstractHandler;

class DivisionField extends AbstractHandler
{
    protected $codename = 'division_field';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('vendor/voyager/formfields.division_field', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }

}