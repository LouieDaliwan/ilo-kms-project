<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Domain\Users\Actions\UserCreateActions;
use Exception;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return 'Hello World!';
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
