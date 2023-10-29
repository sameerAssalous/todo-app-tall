<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Module\Todo\Models\Todo;

class TodoPolicy
{

    public function edit(User $user, Todo $todo): Response
    {
        return $user->id === $todo->user_id
            ? Response::allow()
            : Response::deny(__('You do not own this Todo.'));
    }

    public function update(User $user, Todo $todo): Response
    {
        return $user->id === $todo->user_id
            ? Response::allow()
            : Response::deny(__('You do not own this Todo.'));
    }

    public function delete(User $user, Todo $todo): Response
    {
        return $user->id === $todo->user_id
            ? Response::allow()
            : Response::deny(__('You do not own this Todo.'));
    }

}
