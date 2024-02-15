<?php

namespace App\Models\SIYB;

use App\Models\Users\UserAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory, UserAttributes;

    protected $table = 'siyb_clients';

    protected $guarded = [];

    protected $casts = [
        'metadata' => 'array'
    ];

    protected $with = [
        'agency'
    ];

    public function responses()
    {
        return $this->hasMany(ClientResponse::class, 'siyb_client_id', 'id');
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id', 'id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('first_name', 'like', '%' . $search . '%')
            ->orWhere('middle_name', 'like', '%' . $search . '%')
            ->orWhere('last_name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhereHas('agency', function ($query) use ($search) {
                $query->search($search);
            });
    }
}
