<?php

declare(strict_types=1);

namespace App\Classes\Services\QueryConvenio;

use App\Interfaces\BaseQueryService;
use App\Models\Insurance;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

final class PrestadorListService extends BaseQueryService
{
    public function __construct(Insurance $model, bool $order, ?string $clickColumn)
    {
        parent::__construct($model, $order, $clickColumn);
    }

    protected function getDefaultOrderColumn(): string
    {
        return 'insurance_name';
    }

    protected function getRelationSearchField(string $relation): string
    {
        return match ($relation) {
            'state_name' => 'state',
            'insuratype_name' => 'insuranceType',
            default => 'name'
        };
    }

    protected function applyRelationshipOrder(EloquentBuilder $query, string $relationship, string $order): void
    {
        $tableName = $this->getTableName($relationship);
        $foreignKeyColumn = $this->getForeignKeyColumn($tableName);

        $query->join($tableName, "insurances.{$foreignKeyColumn}", '=', "{$tableName}.id")
            ->orderBy("{$tableName}.{$this->clickColumn}", $order)
            ->select('insurances.*');
    }
}
