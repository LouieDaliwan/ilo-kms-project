<?php

namespace App\Http\Controllers\Wise;

use App\Http\Controllers\Controller;
use App\Models\Wise\Evaluation;
use Illuminate\Http\Request;

class EvaluationsController extends Controller
{
    protected array $data = [
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

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return $this->fetchData();
    }

    protected function fetchData()
    {
        foreach ($this->query() as $evaluation) {
            foreach ($evaluation->evaluation_answers as $question => $answer) {
                $answer = (int) $answer !== 0 ? $answer - 1 : 0;
                $this->data[Evaluation::SORT_QUESTIONS[$question]][Evaluation::EVALUATION_ANSWERS[$answer]]++;
            }
        }
        return $this->data;
    }

    protected function query()
    {
        return Evaluation::get();
    }
}
