<?php

namespace App\Voyager;

use TCG\Voyager\FormFields\AbstractHandler;

class MyUserField extends AbstractHandler
{
    protected $codename = 'my_user_field';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('vendor/voyager/formfields.my_user_field', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }

}