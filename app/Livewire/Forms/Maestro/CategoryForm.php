<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Maestro;

use App\Classes\Utilities\AttributeValidator;
use App\Classes\Utilities\QueryRepository;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Livewire\Form;

final class CategoryForm extends Form
{
    public array $datacategory = [
        'categori_name' => '',
        'categori_code' => '',
        'state_id' => 1,
    ];

    public function categoryStore(): Model
    {
        $validated = $this->validateCategoryData();

        return $this->iniCategory()->create($validated);
    }

    public function categoryUpdate(): Model
    {
        $validated = $this->validateCategoryData($this->datacategory['id']);

        return $this->iniCategory()->update($this->datacategory['id'], $validated);
    }

    public function loadDataCategories($categories): void
    {
        $this->datacategory = $categories->toArray();
    }

    protected function getValidationAttributes(): array
    {
        return [
            'categori_name' => config('nicename.name'),
            'categori_code' => config('nicename.codigo'),
            'state_id' => config('nicename.status'),
        ];
    }

    private function validateCategoryData(?int $excludeId = null): array
    {
        return Validator::make(
            $this->transformCategoryData(),
            $this->getValidationRules($excludeId),
            [],
            $this->getValidationAttributes()
        )->validate();
    }

    private function transformCategoryData(): array
    {
        return [
            'categori_name' => ucwords(mb_strtolower(mb_trim((string) ($this->datacategory['categori_name'] ?? '')))),
            'categori_code' => mb_strtoupper(mb_trim((string) ($this->datacategory['categori_code'] ?? ''))),
            'state_id' => $this->datacategory['state_id'],
        ];
    }

    private function getValidationRules(?int $excludeId = null): array
    {
        return [
            'categori_name' => AttributeValidator::uniqueIdNameLength(4, 'categories', 'categori_name', $excludeId),
            'categori_code' => AttributeValidator::uniqueIdNameLength(4, 'categories', 'categori_code', $excludeId),
            'state_id' => AttributeValidator::requireAndExists('states', 'id', 'id', true),
        ];
    }

    private function iniCategory(): QueryRepository
    {
        return new QueryRepository(new Category());
    }
}
