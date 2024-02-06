<?php

namespace App\Models\SIYB;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $table = 'siyb_agencies';

    protected $guarded = [];

    public function scopeSearch($query, $search)
    {
        return $query->where('agency', 'like', '%' . $search . '%')
            ->orWhere('agency_location', 'like', '%' . $search . '%')
            ->orWhere('name', 'like', '%' . $search . '%')
            ->orWhere('batch_code', 'like', '%' . $search . '%');
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'agency_id', 'id');
    }
}
