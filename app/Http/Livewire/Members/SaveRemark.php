<?php

namespace App\Http\Livewire\Members;

use App\Models\User;
use Livewire\Component;

class SaveRemark extends Component
{
    public $member;
    public $message;

    public function saveRemark()
    {
        $user = User::first();

        $this->member->saveRemarks(auth()->user() ?? $user, $this->message);

        $this->message = '';

        $this->emit('savedRemark');

        $this->dispatchBrowserEvent('scrollDown');
    }

    public function render()
    {
        return view('livewire.members.save-remark');
    }
}
