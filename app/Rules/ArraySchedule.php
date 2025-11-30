<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\ValidationException;

final readonly class ArraySchedule implements ValidationRule
{
    /**
     * Defines the available shift types and their corresponding field names
     */
    private const array SHIFT_TYPES = [
        'morning' => ['start' => 'morning_start', 'end' => 'morning_end'],
        'afternoon' => ['start' => 'afternoon_start', 'end' => 'afternoon_end'],
    ];

    /**
     * @param  array  $scheduleArray  The schedule data to validate
     */
    public function __construct(private array $scheduleArray) {}

    /**
     * Validates the schedule array
     *
     * @param  string  $attribute  The attribute being validated
     * @param  mixed  $value  The value being validated
     * @param  Closure  $fail  The callback to invoke on validation failure
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $activeIndexes = $this->getActiveDayIndexes();

        if ($activeIndexes === []) {
            $this->showMessage('day_of_week', 'se requiere al menos un turno');
        }

        $this->validateSchedules($activeIndexes);
    }

    /**
     * Validates schedules for all active days
     *
     * @param  array  $indexes  Indexes of active days to validate
     */
    private function validateSchedules(array $indexes): void
    {
        foreach ($indexes as $index) {
            $hasValidSchedule = false;

            foreach (self::SHIFT_TYPES as $fields) {
                $start = $this->scheduleArray[$fields['start']][$index] ?? '';
                $end = $this->scheduleArray[$fields['end']][$index] ?? '';

                if (! $this->isEmptyTime($start) || ! $this->isEmptyTime($end)) {
                    $hasValidSchedule = true;
                    $this->validateShiftTimes($start, $end, $fields, $index);
                }
            }

            if (! $hasValidSchedule) {
                $this->showMessage('day_of_week', 'se requiere horario para el turno activo');
            }
        }
    }

    /**
     * Validates start and end times for a shift
     *
     * Checks that:
     * 1. Both start and end times are provided
     * 2. Both times are in valid HH:MM format
     * 3. End time is later than start time
     */
    private function validateShiftTimes(string $start, string $end, array $fields, int $index): void
    {
        // Validate start time
        if ($this->isEmptyTime($start)) {
            $this->showMessage($fields['start'], 'se requiere hora de inicio', $index);
        } elseif (! $this->isValidTimeFormat($start)) {
            $this->showMessage($fields['start'], 'hora debe ser HH:MM', $index);
        }

        // Validate end time
        if ($this->isEmptyTime($end)) {
            $this->showMessage($fields['end'], 'se requiere hora de fin', $index);
        } elseif (! $this->isValidTimeFormat($end)) {
            $this->showMessage($fields['end'], 'hora debe ser HH:MM', $index);
        }

        // Validate that end time is after start time
        if ($this->timeToMinutes($end) <= $this->timeToMinutes($start)) {
            $this->showMessage('day_of_week', 'hora fin turno debe ser mayor a inicio');
        }
    }

    /**
     * Gets the indexes of active days in the schedule
     *
     * @return array Array of indexes for active days
     */
    private function getActiveDayIndexes(): array
    {
        return array_keys(array_filter($this->scheduleArray['day_of_week'] ?? [], fn ($day): bool => $day !== ''));
    }

    /**
     * Checks if a time value is empty or zero
     */
    private function isEmptyTime(string $time): bool
    {
        return $time === '' || $time === '0';
    }

    /**
     * Validates that a time string is in HH:MM format (24-hour)
     *
     * @param  string  $time  The time string to validate
     * @return bool True if the time is in valid format
     */
    private function isValidTimeFormat(string $time): bool
    {
        return (bool) preg_match('/^([01]?\d|2[0-3]):[0-5]\d$/', $time);
    }

    /**
     * Converts a time string in HH:MM format to total minutes
     *
     * @param  string  $time  Time in HH:MM format
     * @return int Total minutes (hours * 60 + minutes)
     */
    private function timeToMinutes(string $time): int
    {
        // Return 0 for invalid time formats to avoid errors
        if (! $this->isValidTimeFormat($time)) {
            return 0;
        }

        [$hours, $minutes] = explode(':', $time);

        return ((int) $hours * 60) + (int) $minutes;
    }

    /**
     * Throws a validation exception with a specific error message
     *
     * @param  string  $inputName  The name of the input field with the error
     * @param  string  $message  The error message to display
     * @param  int|null  $index  Optional index for array inputs
     *
     * @throws ValidationException
     */
    private function showMessage(string $inputName, string $message, ?int $index = null): never
    {
        $key = $index === null ? $inputName : $inputName . '.' . $index;
        throw ValidationException::withMessages([$key => $message]);
    }
}
