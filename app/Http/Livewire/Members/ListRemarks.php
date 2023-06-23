<?php

namespace App\Http\Livewire\Members;

use Livewire\Component;

class ListRemarks extends Component
{
    public $member;

    protected $listeners = ['savedRemark' => 'render'];


    public function render()
    {
        $this->dispatchBrowserEvent('scrollDown');
        return view('livewire.members.list-remarks', [
           'remarks' => $this->member->remarks ?? null
        ]);
    }
}
