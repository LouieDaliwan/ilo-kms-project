<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Domain\Users\Actions\UserCreateActions;
use Domain\Users\Actions\UsersListActions;
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
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
