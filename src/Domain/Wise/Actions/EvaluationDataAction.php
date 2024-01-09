<?php

namespace Domain\Wise\Actions;

use App\Models\Wise\Evaluation;
use App\Models\Wise\Participant;

class EvaluationDataAction  {

    protected array $data = Evaluation::DATA;

    protected array $labels = Evaluation::LABELS;

    public function __invoke(array $request = null, Participant $participant = null)
    {
        return $this->organizeData($participant);
    }

    protected function organizeData($participant = null)
    {
        foreach ($this->query($participant) as $evaluation) {
            foreach ($evaluation->evaluation_answers as $question => $answer) {
                $answer = (int) $answer !== 0 ? $answer - 1 : 0;
                $this->data[Evaluation::SORT_QUESTIONS[$question]][Evaluation::EVALUATION_ANSWERS[$answer]]++;
            }
        }
        return json_encode(['values' => $this->data]);
    }

    protected function query($participant = null)
    {
        $query = Evaluation::query();

        if ($participant) {
            $query = $query->where('wise_participant_id', $participant->id);
        }

        if (request()->has('start_date') && request()->has('end_date')) {
            $query = $query->filterDate(request()->start_date, request()->end_date);
        }

        return $query->get();
    }
}
