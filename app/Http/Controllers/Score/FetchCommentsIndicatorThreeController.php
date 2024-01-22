<?php

namespace App\Http\Controllers\Score;

use App\Http\Controllers\Controller;
use App\Models\Score\IndicatorThree;
use Illuminate\Http\Request;

class FetchCommentsIndicatorThreeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return  $this->fetchComments();
    }

    protected function fetchComments()
    {
        return IndicatorThree::query()
            ->select(['questions_answer'])
            ->skip(request('offset'))
            ->take(request('limit'))
            ->get()->map(function($item) {
                return [
                    'first_question_comment' => $item->questions_answer['first_question_comment'] ?? 'N/A',
                    'second_question_comment' => $item->questions_answer['second_question_comment'] ?? 'N/A',
                    'third_question_comment' => $item->questions_answer['third_question_comment'] ?? 'N/A',
                    'fourth_question_comment' => $item->questions_answer['fourth_question_comment'] ?? 'N/A',
                ];
            });
    }}
