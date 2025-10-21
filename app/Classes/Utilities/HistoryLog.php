<?php

declare(strict_types=1);

namespace App\Classes\Utilities;

final class HistoryLog
{
    public $model;

    public int $id;

    public function __construct(public array $array)
    {
        $this->model = $this->array['model'];
        $this->id = $this->array['id'];

    }

    public function loadHistoryData()
    {
        return $this->getModel()::with(
            ['log' => function ($query): void {
                $query->orderBy('created_at', 'desc');
            }, 'log.user' => function ($query): void {
                $query->select('id', 'name', 'last_name');
            }, 'log.action' => function ($query): void {
                $query->select('id', 'action_inpass');
            }]
        )->find($this->getId());

    }

    public function getModel()
    {
        return mb_trim('App\Models\ ').$this->model;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
