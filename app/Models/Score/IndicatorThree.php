<?php

namespace App\Models\Score;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicatorThree extends Model
{
    use HasFactory;

    const GENDER = [
        'Female'=> 0,
        'Male' => 0,
        'Non-Binary' => 0,
    ];

    const LABELANSWERS = [
        '5' => 'Strongly Agree',
        '4' => 'Agree',
        '3' => 'Neutral',
        '2' => 'Disagree',
        '1' => 'Strongly Disagree',
    ];

    const DATASURVEY = [
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

    ];

    protected $table = 'score_indicator_three';

    protected $guarded = [];

    protected $casts = [
        'questions_answer' => 'array',
    ];
}
