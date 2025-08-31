<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Personal;

use App\Action\PersonAct\UpdatePerson;
use App\Action\PersonalAct\CreateMedic;
use App\Action\PersonalAct\UpdateCreateMedic;
use App\Classes\Personal\EspecialistValidation;
use App\Classes\Personal\MainMedic;
use App\Dto\SpecialistDto;
use App\Models\Medical;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Livewire\Form;

final class SpecialistForm extends Form
{
    public ?SpecialistDto $personData = null;

    /**
     * Specialist-related form state.
     *
     * @var array{
     *   state_id: int,
     *   credential_id: int|null,
     *   specialty_id: int|null,
     *   degree_id: int|null,
     *   medical_codenumber: string,
     *   id?: int
     * }
     */
    public array $dataespecialist = [
        'state_id' => 1,
        'credential_id' => null,
        'specialty_id' => null,
        'degree_id' => null,
        'medical_codenumber' => '',
    ];

    private ?EspecialistValidation $validation = null;

    private ?CreateMedic $createMedic = null;

    private ?UpdatePerson $updatePerson = null;

    private ?UpdateCreateMedic $updateMedic = null;

    private ?MainMedic $mainMedic = null;

    public function setUp(): void
    {
        $this->personData ??= new SpecialistDto();
    }

    /**
     * Store a new medical specialist
     *
     * @throws Exception
     */
    public function specialistStore(): Medical
    {
        $formData = $this->mergeFormData();
        $this->validation()->onCreate($formData);
        $medic = $this->createMedicAction()->handle($formData);
        $this->specialistConfiguration($medic);

        return $medic;
    }

    /**
     * Update specialist information
     * This method validates and updates specialist data by merging form inputs
     * and processing changes for both person and medic entities. It also handles
     * specialist-specific configurations and checks for changes in records.
     *
     * @return Model Updated person or medic model
     *
     * @throws Exception
     */
    public function specialistUpdate(): Model
    {

        $formData = $this->mergeFormData();

        $this->validation()->onUpdate($formData, $this->personData->person_id);

        $person = $this->updatePersonAction()->handle($formData, $this->personData->person_id);

        $emailChange = $person?->wasChanged('person_email');

        $medic = $this->updateMedicAction()->handle($formData, $person);

        $this->specialistConfiguration($medic, $emailChange);

        return $person->wasChanged() ? $person : $medic;
    }

    public function infoMedic(int $medicalId): void
    {
        $this->loadInfoPerson($this->mainMedic()->show($medicalId));
    }

    /**
     * Merge person and specialist data
     *
     * @return array Combined form data
     */
    private function mergeFormData(): array
    {
        return arrayMerge($this->personData->toArray(), $this->dataespecialist);
    }

    private function validation(): EspecialistValidation
    {
        return $this->validation ??= resolve(EspecialistValidation::class);
    }

    private function createMedicAction(): CreateMedic
    {
        return $this->createMedic ??= resolve(CreateMedic::class);
    }

    private function specialistConfiguration(Model $medic, ?bool $emailChange = null): void
    {
        if ($this->dataespecialist['credential_id'] !== null) {
            $this->mainMedic()->attachCredential((int) $this->dataespecialist['credential_id'], $medic, $this->dataespecialist['medical_codenumber']);
            $this->mainMedic()->handleNotification($medic, $emailChange);
        }
    }

    private function mainMedic(): MainMedic
    {
        return $this->mainMedic ??= resolve(MainMedic::class);
    }

    private function updatePersonAction(): UpdatePerson
    {
        return $this->updatePerson ??= resolve(UpdatePerson::class);
    }

    private function updateMedicAction(): UpdateCreateMedic
    {
        return $this->updateMedic ??= resolve(UpdateCreateMedic::class);
    }

    /**
     * Load personal information as medical data
     */
    private function loadInfoPerson(Medical $dataMedic): void
    {
        $prepared = prepareData($dataMedic->person->toArray(), array_keys($this->personData->toArray()));
        $dto = SpecialistDto::fromArray($prepared);
        $dto->person_id = $dataMedic->person->id;

        $this->personData = $dto;

        $this->dataespecialist = prepareData($dataMedic->toArray(), array_keys($this->dataespecialist));
        $this->dataespecialist['medical_codenumber'] = $dataMedic->credentials->first()?->pivot->credential_number;

    }
}
