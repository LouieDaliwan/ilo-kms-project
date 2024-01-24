<?php

namespace App\Models\Wise;

use App\Models\Users\UserAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory, UserAttributes;

    const GENDER = [
        'Male' => 0,
        'Female' => 0,
    ];
    const SECTOR = [
         'Agriculture' => 0,
         'Manufacturing' => 0,
         'Small Construction' => 0,
         'Indigenous People' => 0,
         'PWD' => 0,
         'Informal Sector' => 0,
         'Youth' => 0,
         'Services' => 0,
         'Others' => 0,
    ];

    const POSITION = [
        'Labor' => 0,
        'Management' => 0,
    ];

    protected $guarded = [];
    protected $table = 'wise_participants';
    protected $casts = [
        'ilo_timestamp' => 'datetime',
        'is_business_registered' => 'boolean',
        'beneficiary_of_gov_project' => 'boolean',
    ];

    public function plusActivityReport()
    {
        return $this->hasMany(ActivityPlusReport::class, 'wise_participant_id', 'id');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'wise_participant_id', 'id');
    }

    public function scopeSearch($query, string $terms = null)
    {
        collect(explode(' ',$terms))->each(function($term) use ($query) {
            $term = '%'.$term.'%';
            $query->where(function($query) use ($term) {
                $query->where('first_name', 'like', $term)
                    ->orWhere('last_name', 'like', $term)
                    ->orWhere('email', 'like', $term);
            });
        });

    }
}
