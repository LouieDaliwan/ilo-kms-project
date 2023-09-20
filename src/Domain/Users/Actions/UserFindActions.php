<?php

namespace Domain\Users\Actions;

use App\Models\User;

class UserFindActions
{
    public function __invoke($id)
    {
        return User::findOrFail($id);
    }
}
