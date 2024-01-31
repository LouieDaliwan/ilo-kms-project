<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Domain\Users\Actions\UserCreateActions;
use Domain\Users\Actions\UserFindActions;
use Domain\Users\Actions\UsersListActions;
use Domain\Users\Actions\UserUpdateActions;
use Exception;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return UserResource::collection((new UsersListActions)());
    }

    /**
     * @throws Exception
     */
    public function store(Request $request)
    {
        return (new UserCreateActions)($request->get('data'));
    }

    public function show($id)
    {
        return new UserResource((new UserFindActions)($id));
    }

    public function update(Request $request, $id)
    {
        return new UserResource((new UserUpdateActions)($id, $request->all()));
    }

    public function destroy($id)
    {
    }
}
