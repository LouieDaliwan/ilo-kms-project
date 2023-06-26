@extends('layouts.app')

@section('content')
        <div class="mb-10">
            <a href="/members" class="ml-[50px] mb-20 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> <- Back</a>
        </div>



        <div class="flex flex-row space-x-10 justify-center content-center">
            <div>
                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
                        </li>
                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Dgroup</button>
                        </li>
                    </ul>
                </div>
                <div id="myTabContent" class="flex flex-row content-center justify-center w-full ml-auto mr-auto">
                    <div class="hidden rounded-lg bg-white-50 dark:bg-white-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        @include('members.includes.details')
                    </div>

                    <div class="hidden rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                        @include('members.includes.details')
                    </div>
                </div>
            </div>


            <div class="w-full ml-auto mr-auto flex flex-col justify-center content-center  max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
                <livewire:members.list-remarks :member="$user" />
                <livewire:members.save-remark  :member="$user"/>
            </div>
        </div>
@endsection
