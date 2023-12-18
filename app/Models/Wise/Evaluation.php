<?php

namespace App\Models\Wise;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'wise_participants_evaluation';
}
