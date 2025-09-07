<?php

declare(strict_types=1);

namespace App\Classes\Utilities;

final class HistoryLog
{
    public $model;

    public int $id;

    public array $array;

    public function __construct($array)
    {
        $this->array = $array;
        $this->model = $array['model'];
        $this->id = $array['id'];

    }

    public function loadHistoryData()
    {
        return $this->getModel()::with(['log' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }, 'log.user' => function ($query) {
            $query->select('id', 'name', 'last_name');
        }, 'log.action' => function ($query) {
            $query->select('id', 'action_inpass');
        }])->find($this->getId());

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
