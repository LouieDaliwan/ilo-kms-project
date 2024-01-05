<?php

namespace App\Http\Controllers\Wise;

use App\Http\Controllers\Controller;
use App\Models\Wise\Evaluation;
use Illuminate\Http\Request;

class EvaluationsController extends Controller
{
    protected array $data = Evaluation::DATA;

    protected array $labels = Evaluation::LABELS;

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
        return json_encode(['values' => $this->data]);
    }

    protected function query()
    {
        $query = Evaluation::query();

        if (request()->has('start_date') && request()->has('end_date')) {
            $query = $query->filterDate(request()->start_date, request()->end_date);
        }

        return $query->get();
    }
}
