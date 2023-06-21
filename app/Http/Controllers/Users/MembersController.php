<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\WelcomeNewMember;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddMemberRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);

        return view('members.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddMemberRequest $request)
    {
        $password = Str::password(12);

        $user = User::firstOrCreate([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'username' => $request['username'],
            'gender' => $request['gender'],
            'metadata' => $request['metadata'],
            'password' => Hash::make($password)
        ]);

        // Mail::to($user->email)
        //     ->send(new WelcomeNewMember($user, $password));

        return redirect("/members/{$user->id}");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $id)
    {
        return view('members.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
