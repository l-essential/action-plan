<?php

namespace App\Voyager;

use TCG\Voyager\FormFields\AbstractHandler;

class DepartmentField extends AbstractHandler
{
    protected $codename = 'department_field';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('vendor/voyager/formfields.department_field', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }

}