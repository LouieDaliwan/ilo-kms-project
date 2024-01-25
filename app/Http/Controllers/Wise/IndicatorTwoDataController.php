<?php

namespace App\Http\Controllers\Wise;

use App\Http\Controllers\Controller;
use App\Models\Score\IndicatorTwo;
use Illuminate\Http\Request;

class IndicatorTwoDataController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return $this->fetchData();
    }

    protected function fetchData() : array
    {
        $result = [
            'gender' => IndicatorTwo::GENDER,
            'total_count' => 0,
        ];

        $datasurvey = IndicatorTwo::DATASURVEY;
        $labelAnswers= IndicatorTwo::LABELANSWERS;

        foreach ($this->query() as $data)
        {
            $result['total_count']++;
            $result['gender'][$data['gender']]++;

            foreach ($data['questions_answer'] as $key => $value)
            {
                if(in_array($key, ['first_question_comment', 'second_question_comment'])) continue;

                if($key != 'third_question') {
                    $datasurvey[$key][$labelAnswers[(string) $value]]++;
                } else {
                    $datasurvey[$key][ltrim(preg_replace("/\([^)]+\)/", "", $value))]++;
                }
            }
        }

        return array_merge($result, $datasurvey);
    }

    protected function query()
    {
        $query = IndicatorTwo::query();

        if (request('from') && request('to')) {
            $query = $query->whereBetween('created_at', [request('from'), request('to')]);
        }

        return $query->get();
    }
}
