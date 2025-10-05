<?php

declare(strict_types=1);

namespace App\Classes\Services\QueryConvenio;

use App\Interfaces\AbstractQueryService;
use App\Models\InsurancePlan;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

final class PlanesPrestadorListService extends AbstractQueryService
{
    public function __construct(InsurancePlan $model, bool $order, ?string $clickColumn)
    {
        parent::__construct($model, $order, $clickColumn);
    }

    protected function getRelationSearchField(string $relation): string
    {
        return match ($relation) {
            'state_name' => 'state',
            'insurance_name' => 'insurance',
            default => 'name'
        };
    }

    protected function applyRelationshipOrder(EloquentBuilder $query, string $relationship, string $order): void
    {
        $tableName = $this->getTableName($relationship);
        $foreignKeyColumn = $this->getForeignKeyColumn($tableName);

        $query->join($tableName, "insurance_plans.{$foreignKeyColumn}", '=', "{$tableName}.id")
            ->orderBy("{$tableName}.{$this->clickColumn}", $order)
            ->select('insurance_plans.*');
    }

    protected function getDefaultOrderColumn(): string
    {
        return 'insurance_plan_code';
    }
}
