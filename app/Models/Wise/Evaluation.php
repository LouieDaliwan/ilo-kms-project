<?php

namespace App\Models\Wise;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    CONST DATA = [
        'first_question' => [
            'Strongly Disagree' => 0,
            'Disagree' => 0,
            'Neutral' => 0,
            'Agree' => 0,
            'Strongly Agree' => 0,
        ],
        'second_question' => [
            'Strongly Disagree' => 0,
            'Disagree' => 0,
            'Neutral' => 0,
            'Agree' => 0,
            'Strongly Agree' => 0,
        ],
        'third_question' => [
            'Strongly Disagree' => 0,
            'Disagree' => 0,
            'Neutral' => 0,
            'Agree' => 0,
            'Strongly Agree' => 0,
        ],
        'fourth_question' => [
            'Strongly Disagree' => 0,
            'Disagree' => 0,
            'Neutral' => 0,
            'Agree' => 0,
            'Strongly Agree' => 0,
        ],
        'fifth_question' => [
            'Strongly Disagree' => 0,
            'Disagree' => 0,
            'Neutral' => 0,
            'Agree' => 0,
            'Strongly Agree' => 0,
        ],
        'sixth_question' => [
            'Strongly Disagree' => 0,
            'Disagree' => 0,
            'Neutral' => 0,
            'Agree' => 0,
            'Strongly Agree' => 0,
        ],
    ];

    CONST LABELS = [
        'Strongly Disagree',
        'Disagree',
        'Neutral',
        'Agree',
        'Strongly Agree',
    ];

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

    public function scopeFilterDate($query, string $from, string $to)
    {
        return $query->whereBetween('created_at', [$from, $to]);
    }
}
