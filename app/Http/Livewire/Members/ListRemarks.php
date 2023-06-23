<?php

namespace App\Http\Livewire\Members;

use Livewire\Component;

class ListRemarks extends Component
{
    public $member;

    protected $listeners = ['savedRemark' => 'render'];


    public function render()
    {
        return view('livewire.members.list-remarks', [
           'remarks' => $this->member->remarks ?? null
        ]);
    }
}
