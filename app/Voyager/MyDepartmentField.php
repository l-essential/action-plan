<?php

namespace App\Voyager;

use TCG\Voyager\FormFields\AbstractHandler;

class MyDepartmentField extends AbstractHandler
{
    protected $codename = 'my_department_field';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('vendor/voyager/formfields.my_department_field', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }

}