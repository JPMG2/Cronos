<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use Illuminate\Validation\ValidationException;

final class ArraySchedule implements ValidationRule
{
    public $activeDay;

    public int $itemArrays;

    public array $morningScheduleStart = [];

    public array $morningScheduleEnd = [];

    public array $dayActive = [];

    public function __construct(public array $scheduleArray)
    {
        $this->itemArrays = count($this->scheduleArray);
        $this->activeDay = $this->scheduleArray['day_of_week'];
        $this->morningScheduleStart = $this->scheduleArray['morning_start'];
        $this->morningScheduleEnd = $this->scheduleArray['morning_end'];
    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $this->validateActiveDays();
    }

    private function validateActiveDays(): void
    {
        if (array_filter($this->activeDay, fn ($day): bool => $day !== '') === []) {
            $this->showMessage('day_of_week', 'se requiere al menos un turno');
        }

        $this->validateMorningSchedules();
    }

    private function validateMorningSchedules(): void
    {
        foreach ($this->getActiveDayIndexes() as $index) {
            if (empty($this->morningScheduleStart[$index])) {
                $this->showMessage('morning_start', 'se requiere hora inicio', $index);
            }
        }
    }

    private function getActiveDayIndexes(): array
    {
        return array_keys(array_filter($this->activeDay, fn ($day): bool => $day !== ''));
    }

    private function showMessage(string $nameinput, string $message, ?int $index = null): never
    {
        $key = $index === null ? $nameinput : $nameinput.'.'.$index;
        throw ValidationException::withMessages([$key => $message]);
    }
}
