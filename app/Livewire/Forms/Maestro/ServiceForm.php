<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Maestro;

use App\Classes\Maestro\MainServices;
use App\Classes\Maestro\ServicesValidation;
use App\Dto\ServicesDto;
use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Livewire\Form;

final class ServiceForm extends Form
{
    public ?ServicesDto $dataservice = null;

    private ?MainServices $mainServices = null;

    private ?ServicesValidation $validation = null;

    public function setUp(): void
    {
        $this->dataservice ??= new ServicesDto();
    }

    public function serviceStore(): Service
    {
        $validated = $this->validation()
            ->validateServiceData(null, $this->dataservice->toArray());

        return $this->mainServices()->create($validated);
    }

    public function serviceUpdate(): Model
    {
        $validated = $this->validation()
            ->validateServiceData($this->dataservice->id, $this->dataservice->toArray());

        return $this->mainServices()->update($this->dataservice->id, $validated);
    }

    public function loadDataServices(int $idService): void
    {
        $this->setUp();

        $service = $this->mainServices()->showServiceInfo($idService);

        $serviceData = prepareData($service->toArray(), array_keys($this->dataservice->toArray()));
        $dto = ServicesDto::fromArray($serviceData);
        $this->dataservice = $dto;
        $this->dataservice->categori_name = $service->category->categori_name;
    }

    public function validateBasicInfo(): void
    {
        $data = [
            'service_name' => ucwords(mb_strtolower(mb_trim((string) ($this->dataservice->service_name ?? '')))),
            'service_code' => mb_strtoupper(mb_trim((string) ($this->dataservice->service_code ?? ''))),
            'category_id' => $this->dataservice->category_id ?? null,
        ];

        $rules = [
            'service_name' => 'required|min:4',
            'service_code' => 'required|min:4',
            'category_id' => 'required|exists:categories,id',
        ];

        $attributes = [
            'service_name' => config('nicename.service'),
            'service_code' => config('nicename.codigo'),
            'category_id' => config('nicename.category'),
        ];

        Validator::make($data, $rules, [], $attributes)->validate();
    }

    private function validation(): ServicesValidation
    {
        return $this->validation ??= new ServicesValidation();
    }

    private function mainServices(): MainServices
    {
        return $this->mainServices ??= resolve(MainServices::class);
    }
}
