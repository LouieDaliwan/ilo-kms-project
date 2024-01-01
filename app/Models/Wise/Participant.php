<?php

namespace App\Models\Wise;

use App\Models\Users\UserAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory, UserAttributes;

    protected $guarded = [];

    protected $table = 'wise_participants';

    protected $casts = [
        'ilo_timestamp' => 'datetime',
        'is_business_registered' => 'boolean',
        'beneficiary_of_gov_project' => 'boolean',
    ];

    public function plusActivityReport()
    {
        return $this->hasMany(PlusActivityReport::class, 'wise_participant_id', 'id');
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
