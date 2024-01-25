<?php

namespace App\Http\Controllers\Wise;

use App\Http\Controllers\Controller;
use App\Models\Score\IndicatorOne;
use Illuminate\Http\Request;

class IndicatorOneDataController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return $this->fetchData();
    }

    /**
     * Fetch data from database.
     * @return array
     */
    protected function fetchData() : array
    {
        $result = [
            'gender' => IndicatorOne::GENDER,
            'total_count' => 0,
        ];

        $datasurvey = IndicatorOne::DATASURVEY;
        $labelAnswers = IndicatorOne::LABELANSWERS;


        foreach ($this->query() as $data)
        {
            $result['total_count']++;
            $result['gender'][$data['gender']]++;

            foreach ($data['questions_answer'] as $key => $value)
            {
                $datasurvey[$key][$labelAnswers[(string) $value]]++;
            }
        }

        return array_merge($result, $datasurvey);
    }

    protected function query()
    {
        $query = IndicatorOne::query();

        if (request('from') && request('to')) {
            $query = $query->whereBetween('created_at', [request('from'), request('to')]);
        }

        return $query->get();
    }
}
