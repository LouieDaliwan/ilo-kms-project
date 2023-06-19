@extends('layouts.app')

@section('content')
    <div class="mt-20">
        <div class="align-middle justify-center w-full ml-auto mr-auto">
            <table class="shadow-lg bg-white border-collapse">
                <tr>
                  <th class="bg-blue-100 border text-left px-8 py-4">First Name</th>
                  <th class="bg-blue-100 border text-left px-8 py-4">Email</th>
                  {{-- <th class="bg-blue-100 border text-left px-8 py-4"></th> --}}
                </tr>
                @foreach($users as $user)
                <tr class="hover:bg-gray-50">
                  <td class="border px-8 py-4">{{ $user->first_name }}</td>
                  <td class="border px-8 py-4">{{ $user->email }}</td>
                  {{-- <td class="border px-8 py-4">Italy</td> --}}
                </tr>
                @endforeach


                {!! $users->links('pagination::tailwind') !!}
              </table>
        </div>
    </div>
@endsection
