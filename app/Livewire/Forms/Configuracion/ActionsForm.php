<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Configuracion;

use App\Classes\Services\ModelService;
use App\Classes\Utilities\NotifyQuerys;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Livewire\Form;

final class ActionsForm extends Form
{
    public $dataaction = [
        'role_id' => '',
        'action_id' => [],
    ];

    public function actionStore(): array
    {

        Validator::make(
            [
                'role_id' => $this->dataaction['role_id'],
                'action_id' => $this->dataaction['action_id'],
            ],
            [
                'role_id' => 'required|gt:0',
                'action_id' => 'required|array|min:1',
            ],
            [],
            [
                'role_id' => config('nicename.role'),
                'action_id' => config('nicename.action'), ],
        )->validate();
        $services = $this->iniService();

        return NotifyQuerys::msgCreateUpdateMany(
            $services
                ->addWithRelationship(
                    (int) $this->dataaction['role_id'],
                    $this->dataaction['action_id'],
                    'actions',
                ),
        );
    }

    public function actionData(int $intRole): void
    {
        $services = $this->iniService();
        $data = $services->showWithRelationship((int) $this->dataaction['role_id'], 'showActionRelashion');
        $this->dataaction['action_id'] = count($data->actions) > 0 ? $data->actions->pluck('id')->toArray() : [];

    }

    private function iniService(): ModelService
    {
        return new ModelService(new Role());
    }
}
