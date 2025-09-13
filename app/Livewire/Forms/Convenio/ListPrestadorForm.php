<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Convenio;

use Livewire\Form;

final class ListPrestadorForm extends Form
{
    public array $tableHeaders = [
        [
            'name' => 'ID',
            'isClickable' => false,
            'clickName' => '',
            'with' => '',
            'max' => '',
            'mask' => '',
        ],
        [
            'name' => 'Nombre',
            'isClickable' => true,
            'clickName' => 'insurance_name',
            'with' => 'w-64',
            'max' => '10',
            'mask' => 'aaaaaaaaaa',
        ],
        [
            'name' => 'Siglas',
            'isClickable' => true,
            'clickName' => 'insurance_acronym',
            'with' => 'w-36',
            'max' => '10',
            'mask' => 'aaaaaaaaaa',
        ],
        [
            'name' => 'Tipo',
            'isClickable' => true,
            'clickName' => 'insuratype_name',
            'with' => 'w-32',
            'max' => '10',
            'mask' => 'aaaaaaaaaa',
        ],
        [
            'name' => 'Código',
            'isClickable' => true,
            'clickName' => 'insurance_code',
            'with' => 'w-36',
            'max' => '4',
            'mask' => '',
        ],
        [
            'name' => 'Estatus',
            'isClickable' => true,
            'clickName' => 'state_name',
            'with' => 'w-32',
            'max' => '6',
            'mask' => 'aaaaaa',
        ],
        [
            'name' => '',
            'isClickable' => false,
            'clickName' => '',
            'with' => '',
            'max' => '',
            'mask' => '',
        ],
    ];
}
