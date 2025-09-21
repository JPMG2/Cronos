<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Convenio;

use App\Classes\Convenio\MaindPrestador;
use App\Classes\Convenio\PrestadorValidation;
use App\Dto\PrestadorDto;
use App\Models\Insurance;
use Illuminate\Database\Eloquent\Model;
use Livewire\Form;

final class PrestadorForm extends Form
{
    public ?PrestadorDto $dataobrasocial = null;

    private ?PrestadorValidation $validation = null;

    public function setUp(): void
    {
        $this->dataobrasocial ??= new PrestadorDto();
    }

    public function insuranceStore(): Model
    {

        $data = $this->validation()->validateServiceData(null, ($this->dataobrasocial->toArray()));

        return $this->iniService()->create($data);
    }

    public function insuranceUpdate(): Model
    {
        $data = $this->validation()->validateServiceData($this->dataobrasocial->id, ($this->dataobrasocial->toArray()));

        return $this->iniService()->update($this->dataobrasocial->id, $data);
    }

    public function infoPrestador($idInsurance): Model
    {
        $data = $this->fetchProviderData($idInsurance);

        $this->loadDataIntoForm($data);

        return $data;
    }

    private function validation(): PrestadorValidation
    {
        return $this->validation ??= new PrestadorValidation();
    }

    private function iniService(): MaindPrestador
    {
        return new MaindPrestador(new Insurance());
    }

    private function fetchProviderData($idInsurance): Model
    {
        return $this->iniService()->showProvedorInfo($idInsurance);
    }

    private function loadDataIntoForm(Model $data): void
    {
        $prepared = prepareData($data->toArray(), array_keys($this->dataobrasocial->toArray()));
        $dto = PrestadorDto::fromArray($prepared);

        $this->dataobrasocial = $dto;

        $this->dataobrasocial->province_id = $data->city?->province->id;
        $this->dataobrasocial->city_id = $data->city_id;

        // Set the insurance type name from the relationship
        $this->dataobrasocial->insurance_type_name = $data->insuranceType?->insuratype_name ?? '';

    }
}
