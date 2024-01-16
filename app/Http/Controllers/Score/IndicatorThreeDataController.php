<?php

namespace App\Http\Controllers\Score;

use App\Http\Controllers\Controller;
use App\Models\Score\IndicatorThree;
use Illuminate\Http\Request;

class IndicatorThreeDataController extends Controller
{
    protected string $model = IndicatorThree::class;
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
            'gender' => $this->model::GENDER,
            'total_count' => 0,
        ];

        $datasource = $this->model::DATASURVEY;
        $labelAnswers = $this->model::LABELANSWERS;


        foreach ($this->query() as $data)
        {
            $result['total_count']++;
            $result['gender'][$data['gender']]++;

            foreach ($data['questions_answer'] as $key => $value)
            {
                if(key_exists($key, $datasource)) {
                    $datasource[$key][$labelAnswers[(string) $value]]++;
                }
            }
        }

        return array_merge($result, $datasource);
    }

    protected function query()
    {
        $query = $this->model::query();

        if (request('from') && request('to')) {
            $query = $query->whereBetween('created_at', [request('from'), request('to')]);
        }

        return $query->get();
    }
}
