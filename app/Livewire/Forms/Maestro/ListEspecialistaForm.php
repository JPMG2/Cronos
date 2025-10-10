<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Maestro;

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
            'style' => '',
        ],
        [
            'name' => 'Documento',
            'isClickable' => true,
            'clickName' => 'num_document',
            'with' => 'w-32',
            'max' => '6',
            'mask' => '999999',
            'style' => '',
        ],
        [
            'name' => 'Nombre',
            'isClickable' => true,
            'clickName' => 'person_name',
            'with' => 'w-36',
            'max' => '10',
            'mask' => 'aaaaaaaaaa',
            'style' => '',
        ],
        [
            'name' => 'Apellido',
            'isClickable' => true,
            'clickName' => 'person_lastname',
            'with' => 'w-36',
            'max' => '10',
            'mask' => 'aaaaaaaaaa',
            'style' => '',
        ],
        [
            'name' => 'Matrícula',
            'isClickable' => true,
            'clickName' => 'credential_number',
            'with' => 'w-32',
            'max' => '10',
            'mask' => '9999999999',
            'style' => 'hidden md:table-cell',
        ],
        [
            'name' => 'Especialidad',
            'isClickable' => true,
            'clickName' => 'specialty_name',
            'with' => 'w-32',
            'max' => '10',
            'mask' => 'aaaaaaaaaa',
            'style' => 'hidden md:table-cell',
        ],
        [
            'name' => 'Télefono',
            'isClickable' => true,
            'clickName' => 'person_phone',
            'with' => 'w-32',
            'max' => '6',
            'mask' => '999999',
            'style' => 'hidden md:table-cell',
        ],
        [
            'name' => '',
            'isClickable' => false,
            'clickName' => '',
            'with' => '',
            'max' => '',
            'mask' => '',
            'style' => '',
        ],
    ];
}
