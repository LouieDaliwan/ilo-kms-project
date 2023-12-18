<?php

namespace App\Models\Wise;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlusActivityReport extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'wise_plus_activity_report';

    protected $casts = [
        'action_item_1' => 'array',
        'action_item_2' => 'array',
        'action_item_3' => 'array',
    ];
}
