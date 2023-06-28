<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dgroup extends Model
{
    use HasFactory;

    //State for Dgroup
    const ACTIVE = 'Active';

    //Type of Dgroup
    const SINGLES = 'Singles';

    protected $guarded = [];

    protected $table = 'dgroups';

    protected static function booted(): void
    {
        static::created(function (Dgroup $dgroup) {
            $dgroup->status = static::ACTIVE;
            $dgroup->life_stage_type = static::SINGLES;
            $dgroup->save();
        });
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }
}
