<?php

namespace Domain\Users\Actions;

use App\Models\User;

class UserUpdateActions
{
    public function __invoke($id, $data): User
    {
        $user = User::findOrFail($id);

        $user->update($data);

        return $user;
    }
}
