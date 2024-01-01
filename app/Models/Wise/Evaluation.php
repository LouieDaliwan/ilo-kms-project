<?php

namespace App\Models\Wise;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    CONST EVALUATION_ANSWERS = [
        'Strongly Disagree',
        'Disagree',
        'Neutral',
        'Agree',
        'Strongly Agree',
    ];

    CONST SORT_QUESTIONS = [
        'The training objectives were met' => 'first_question',
        'Answer if you are an Employer: As an employer, I have an improved understanding of my legal duties and responsibilities related to OSH' => 'second_question',
        'Answer if you are WORKER: As a worker, I have an improved understanding of my legal duties and responsibilities related to OSH.' => 'third_question',
        'I have learned how to conduct hazard and risk assessment' => 'fourth_question',
        'I have acquired new knowledge on how to prevent and mitigate COVID-19 and other health hazards in the workplace' => 'fifth_question',
        'I will recommend this training to other MSMEs and informal businesses' => 'sixth_question',
    ];

    protected $guarded = [];

    protected $table = 'wise_participants_evaluation';

    protected $casts = [
        'evaluation_answers' => 'array',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class, 'wise_participant_id', 'id');
    }
}
