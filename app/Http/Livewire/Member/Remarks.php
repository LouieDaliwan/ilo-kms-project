<?php

namespace App\Http\Livewire\Member;

use Livewire\Component;

class Remarks extends Component
{
    public $user;

    public function render()
    {
        return view('livewire.member.remarks');
    }
}
