<?php

namespace App\Policies;

use App\Models\Action;
use App\Models\User;

class ActionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function created(User $user, Action $action)
    {
        if ($this->checkUser($user)) {
            return true;
        }
        $myAction = $action->where('action_name', 'created')->first();

        return $myAction->roles()
            ->where('role_id', $user->getUserRoleId())
            ->exists();

    }

    private function checkUser($user)
    {
        return (bool) $user->hasAnyRole(['Owner', 'Administrator']);

    }

    public function history(User $user, Action $action)
    {
        if ($this->checkUser($user)) {
            return true;
        }
        $myAction = $action->where('action_name', 'history')->first();

        return $myAction->roles()
            ->where('role_id', $user->getUserRoleId())
            ->exists();

    }

    public function export(User $user, Action $action)
    {
        if ($this->checkUser($user)) {
            return true;
        }
        $myAction = $action->where('action_name', 'export')->first();

        return $myAction->roles()
            ->where('role_id', $user->getUserRoleId())
            ->exists();

    }

    public function print(User $user, Action $action)
    {
        if ($this->checkUser($user)) {
            return true;
        }
        $myAction = $action->where('action_name', 'print')->first();

        return $myAction->roles()
            ->where('role_id', $user->getUserRoleId())
            ->exists();

    }

    public function updated(User $user, Action $action)
    {
        if ($this->checkUser($user)) {
            return true;
        }
        $myAction = $action->where('action_name', 'updated')->first();

        return $myAction->roles()
            ->where('role_id', $user->getUserRoleId())
            ->exists();

    }

    public function deleted(User $user, Action $action)
    {
        if ($this->checkUser($user)) {
            return true;
        }
        $myAction = $action->where('action_name', 'deleted')->first();

        return $myAction->roles()
            ->where('role_id', $user->getUserRoleId())
            ->exists();

    }

    public function view(User $user, Action $action)
    {
        if ($this->checkUser($user)) {
            return true;
        }
        $myAction = $action->where('action_name', 'view')->first();

        return $myAction->roles()
            ->where('role_id', $user->getUserRoleId())
            ->exists();

    }

    public function refresh(User $user, Action $action)
    {
        if ($this->checkUser($user)) {
            return true;
        }
        $myAction = $action->where('action_name', 'refresh')->first();

        return $myAction->roles()
            ->where('role_id', $user->getUserRoleId())
            ->exists();

    }
}
