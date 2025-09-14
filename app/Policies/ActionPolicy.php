<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Action;
use App\Models\User;

final class ActionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function before(User $user, string $ability): ?bool
    {
        return $user->hasAnyRole(['Owner', 'Administrator']) ? true : null;
    }

    public function created(User $user, Action $action)
    {
        return $this->allowedFor($user, 'created');

    }

    public function history(User $user, Action $action)
    {
        return $this->allowedFor($user, 'history');
    }

    public function export(User $user, Action $action)
    {
        return $this->allowedFor($user, 'export');

    }

    public function print(User $user, Action $action)
    {
        return $this->allowedFor($user, 'print');
    }

    public function updated(User $user, Action $action)
    {
        return $this->allowedFor($user, 'updated');
    }

    public function deleted(User $user, Action $action)
    {
        return $this->allowedFor($user, 'deleted');
    }

    public function view(User $user, Action $action)
    {
        return $this->allowedFor($user, 'view');
    }

    public function refresh(User $user, Action $action)
    {
        return $this->allowedFor($user, 'refresh');
    }

    private function allowedFor(User $user, string $actionName): bool
    {
        $myAction = Action::query()->where('action_name', $actionName)->first();

        return $myAction?->roles()
            ->where('role_id', $user->getUserRoleId())
            ->exists() ?? false;
    }
}
