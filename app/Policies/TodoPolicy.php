<?php

namespace App\Policies;

use App\Models\Todo;
use App\Models\User;

class TodoPolicy
{
    /**
     * 一覧を見られるか？
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * このTodoを見られるか？
     */
    public function view(User $user, Todo $todo): bool
    {
        return $user->id === $todo->user_id;
    }

    /**
     * 作成できるか？
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * 更新できるか？
     */
    public function update(User $user, Todo $todo): bool
    {
        return $user->id === $todo->user_id;
    }

    /**
     * 削除できるか？
     */
    public function delete(User $user, Todo $todo): bool
    {
        return $user->id === $todo->user_id;
    }
}
