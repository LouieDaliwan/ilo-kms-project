<?php

namespace App\Http\Livewire\Member;

use App\Models\User;
use Livewire\Component;

class Remarks extends Component
{
    public $user;

    public function postRemarks(User $user, $comment)
    {
        $user->remarks()->create([
            'comments' => $comment
        ]);
        
        $this->emit('update-list-remarks');
    }

    public function render()
    {
        return view('livewire.member.remarks');
    }
}
