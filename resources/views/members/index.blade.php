@extends('layouts.app')

@section('content')
    <div class="mt-8">
        <div class="row">
            <div class="my-5 flex flex-none space-x-10 w-full justify-center align-middle">
                <p class="font-weight-bold" style="font-size: 30px;">Members</p>
                <a href="{{ route('members.create') }}" class="rounded-full bg-blue-300 justify-center align-center mx-auto text-white bold w-20 text-center pt-3">
                    Add
                </a>
            </div>
        </div>


        <div class="flex align-middle justify-center w-full">
            <table class="shadow-lg bg-white border-collapse table-bordered table-sm">
                <tr>
                    <th class="bg-blue-100 border text-left px-8 py-4">ID No.</th>
                    <th class="bg-blue-100 border text-left px-8 py-4">Name</th>
                    <th class="bg-blue-100 border text-left px-8 py-4">Email</th>
                    <th class="bg-blue-100 border text-left px-8 py-4">Username</th>
                </tr>
                @foreach($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="border px-8 py-4">
                        <a class="" href="/members/{{$user->id}}">{{ $user->id }}</a>
                    </td>
                    <td class="border px-8 py-4">{{ $user->first_name }}</td>
                    <td td class="border px-8 py-4">{{ $user->email }}</td>
                    <td class="border px-8 py-4">{{ $user->username }}</td>
                </tr>
                @endforeach
              </table>
        </div>
        <div class="row">
            <div class="mt-8">
                {{ $users->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
@endsection
