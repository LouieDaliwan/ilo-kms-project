<?php

namespace Domain\Users\Actions;

use App\Models\User;

class UsersListActions
{
    public function __invoke($args = [])
    {
        $model = User::query();

        if (request()->has('search')) {
            $model = $model->where('first_name', 'like', '%'.request()->get('search').'%')
                ->where('middle_name', 'like', '%'.request()->get('search').'%')
                ->where('last_name', 'like', '%'.request()->get('search').'%');
        }

        return $model->paginate(request()->get('itemPerPage'));
    }

    public function havePagination()
    {

    }
}
