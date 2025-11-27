<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Convenio;

use App\Dto\InsurancePlanCoverageDto;
use App\Models\Service;
use Illuminate\Support\Collection;
use Livewire\Form;

final class CoberturaForm extends Form
{
    public ?InsurancePlanCoverageDto $dataCobertura;

    public function setUp(): void
    {
        $this->dataCobertura ??= new InsurancePlanCoverageDto();
    }

    public function serviceArray(): array
    {
        $group = Service::query()->groups();
        $final = Service::query()->final();

        return $this->allServices($group) + $this->allServices($final);
    }

    public function servicesSelected(?array $services): Collection
    {
        return Service::with(['children'])
            ->whereIn('id', $services)
            ->orderBy('type')
            ->orderBy('service_name')
            ->get();
    }

    protected function allServices($query): array
    {
        return $query
            ->byState([1])
            ->orderBy('service_name')
            ->get()
            ->mapWithKeys(fn ($service) => [
                $service->id => "{$service->service_code} - {$service->service_name}",
            ])
            ->toArray();

    }
}
