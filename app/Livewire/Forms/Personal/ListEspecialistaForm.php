<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Personal;

use Livewire\Form;

final class ListEspecialistaForm extends Form
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
            'with' => '',
            'max' => '10',
            'mask' => 'aaaaaaaaaa',
        ],
        [
            'name' => 'Matrícula',
            'isClickable' => true,
            'clickName' => 'credential_number',
            'with' => 'w-32',
            'max' => '10',
            'mask' => '9999999999',
        ],
        [
            'name' => 'Especialidad',
            'isClickable' => true,
            'clickName' => 'specialty_name',
            'with' => 'w-32',
            'max' => '10',
            'mask' => 'aaaaaaaaaa',
        ],
        [
            'name' => 'Estatus',
            'isClickable' => false,
            'clickName' => 'state_name',
            'with' => '',
            'max' => '',
            'mask' => '',
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
