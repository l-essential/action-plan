<?php

namespace App\Voyager;

use TCG\Voyager\FormFields\AbstractHandler;

class JabatanField extends AbstractHandler
{
    protected $codename = 'jabatan_field';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('vendor/voyager/formfields.jabatan_field', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }

}