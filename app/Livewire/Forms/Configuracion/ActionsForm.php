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

    public function actionStore()
    {

        $validated = Validator::make(
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
                'action_id' => config('nicename.action'), ]
        )->validate();
        $services = $this->iniService();

        return NotifyQuerys::msgCreateUpdateMany($services
            ->addWithRelationship((int) $this->dataaction['role_id'],
                $this->dataaction['action_id'],
                'actions'
            ));
    }

    public function actionData(int $intRole)
    {
        $services = $this->iniService();
        $data = $services->showWithRelationship((int) $this->dataaction['role_id'], 'showActionRelashion');
        if (count($data->actions) > 0) {
            $this->dataaction['action_id'] = $data->actions->pluck('id')->toArray();
        } else {
            $this->dataaction['action_id'] = [];
        }

    }

    protected function iniService()
    {
        return app()->make(ModelService::class, ['model' => new Role]);
    }
}
