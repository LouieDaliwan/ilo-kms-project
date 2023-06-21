<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class SaveRemark extends Component
{
    public $user;

    public function saveRemark($remark)
    {
        $this->user->saveRemarks(auth()->user(), $remark);

        $this->emit('savedRemark');
    }

    public function render()
    {
        return view('livewire.save-remark');
    }
}
