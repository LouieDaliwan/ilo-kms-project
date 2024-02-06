<?php

namespace App\Models\SIYB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'siyb_clients';

    protected $guarded = [];

    protected $casts = [
        'metadata' => 'array'
    ];

    public function responses()
    {
        return $this->hasMany(ClientResponse::class, 'siyb_client_id', 'id');
    }
}
