<?php

namespace App\Models\SIYB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientResponse extends Model
{
    use HasFactory;

    protected $table = 'siyb_client_responses';

    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class, 'siyb_client_id', 'id');
    }
}
