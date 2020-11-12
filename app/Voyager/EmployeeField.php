<?php

namespace App\Voyager;

use TCG\Voyager\FormFields\AbstractHandler;

class EmployeeField extends AbstractHandler
{
    protected $codename = 'employee_field';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('vendor/voyager/formfields.employee_field', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }

}