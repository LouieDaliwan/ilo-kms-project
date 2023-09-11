<?php

namespace Domain\Users\Actions;

use App\Models\User;

class UsersListActions
{
    public function __invoke($args = [])
    {
        return User::paginate(10);
    }
}
