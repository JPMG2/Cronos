<?php

namespace App\Traits;

use App\Models\Action;
use App\Models\Log;

trait RecordActivity
{
    public $getChanges;

    protected static function bootRecordActivity()
    {
        foreach (self::getRecordEvents() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }
    }

    protected static function getRecordEvents()
    {
        return ['created', 'updated', 'deleted'];
    }

    protected function recordActivity($event)
    {
        if ($event === 'updated') {
            $this->getChanges = $this->getChanges();
        }

        $this->log()->create([
            'user_id' => auth()->id(),
            'action_id' => $this->getActivityId($event),
            'log_message' => 'ju',
            'log_change' => ! empty($this->getChanges) ? json_encode($this->getChanges) : null,
        ]);
    }

    public function getChanges()
    {
        $keychange = array_keys($this->getDirty());
        $keyorigin = $this->getOriginal();
        foreach ($keychange as $key) {
            $this->getChanges[$key] = [
                'old' => $keyorigin[$key],
                'new' => $this->getAttributes()[$key],
            ];
        }

        return $this->getChanges;
    }

    public function log()
    {
        return $this->morphMany(Log::class, 'model');
    }

    protected function getActivityId($event)
    {

        return Action::where('action_name', $event)->first()->id;

    }
}
