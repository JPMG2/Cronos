<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Clinico;

use Livewire\Form;

final class ListPatientForm extends Form
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
            'name' => 'Documento',
            'isClickable' => true,
            'clickName' => 'num_document',
            'with' => 'w-32',
            'max' => '6',
            'mask' => '999999',
        ],
        [
            'name' => 'Nombre',
            'isClickable' => true,
            'clickName' => 'person_name',
            'with' => 'w-36',
            'max' => '10',
            'mask' => 'aaaaaaaaaa',
        ],
        [
            'name' => 'Apellido',
            'isClickable' => true,
            'clickName' => 'person_lastname',
            'with' => 'w-32',
            'max' => '10',
            'mask' => 'aaaaaaaaaa',
        ],
        [
            'name' => 'Genero',
            'isClickable' => true,
            'clickName' => 'gender_name',
            'with' => 'w-32',
            'max' => '4',
            'mask' => 'aaaa',
        ],
        [
            'name' => 'Teléfono',
            'isClickable' => true,
            'clickName' => 'person_phone',
            'with' => 'w-32',
            'max' => '6',
            'mask' => '999999',
        ],
        [
            'name' => 'Correo',
            'isClickable' => true,
            'clickName' => 'person_email',
            'with' => 'w-full',
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
