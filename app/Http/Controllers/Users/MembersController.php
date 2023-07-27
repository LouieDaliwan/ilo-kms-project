<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddMemberRequest;
use App\Mail\WelcomeNewMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
            'password' => Hash::make($password),
        ]);

        Mail::to($user->email)
            ->send(new WelcomeNewMember($user, $password));

        return redirect("/members/{$user->id}");
    }

    /**
     * Display the specified resource.
     */
    public function show($user)
    {
        $user = User::findOrFail($user);

        return view('members.show', compact('user'));
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
    public function update(Request $request, string $user)
    {
        $user = User::findOrFail($user);

        $user->first_name = $request['first_name'];
        $user->middle_name = $request['middle_name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];
        $user->username = $request['username'];
        $user->gender = $request['gender'];
        $user->metadata = [
            'phone_number' => $request['phone_number'] ?? null,
            'age' => $request['age'] ?? null,
            'address' => $request['address'] ?? null,
            'company' => $request['company'] ?? null,
            'source' => $request['source'] ?? null,
            'social_media' => $request['social_media'] ?? null,
        ];

        $user->save();

        return redirect("/members/{$user->id}");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
