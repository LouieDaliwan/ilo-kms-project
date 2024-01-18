<?php

namespace App\Http\Controllers\Score;

use App\Http\Controllers\Controller;
use App\Models\Score\IndicatorTwo;
use Illuminate\Http\Request;

class FetchCommentsIndicatorTwoController extends Controller
{

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return  $this->fetchComments();
    }

    protected function fetchComments()
    {
        return IndicatorTwo::query()
            ->select(['questions_answer'])
            ->skip(request('offset'))
            ->take(request('limit'))
            ->get()->map(function($item) {
                return [
                    'first_question_comment' => $item->questions_answer['first_question_comment'],
                    'second_question_comment' => $item->questions_answer['second_question_comment'],
                ];
            });
    }
}
