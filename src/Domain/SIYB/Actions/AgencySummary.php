<?php

namespace Domain\SIYB\Actions;

use App\Models\SIYB\Agency;

class AgencySummary
{
    protected string $model = Agency::class;

    protected array $summary = [
        'entrepreneur' => [
            'total_planned_toe' => 0,
            'total_conducted_toe' => 0,
        ],
        'msme' => [
            'total_planned_msme' => 0,
            'total_conducted_msme' => 0,
        ],
    ];

    protected array $toe = [
        'planned_toe' => 0,
        'conducted_toe' => 0,
    ];

    protected array $msme = [
        'planned_msme' => 0,
        'conducted_msme' => 0,
    ];

    public function __invoke()
    {
        return $this->summaryData();
    }

    protected function summaryData() : array
    {
        foreach ($this->query()->get() as $trainee) {

            $this->summary['entrepreneur']['total_planned_toe'] += $trainee->no_of_planned_toe;
            $this->summary['entrepreneur']['total_conducted_toe'] += $trainee->no_of_toe_conducted_activity_report;
            $this->summary['msme']['total_planned_msme'] += $trainee->estimated_msme_to_be_trained;
            $this->summary['msme']['total_conducted_msme'] += $trainee->no_msme_trained;

            isset($this->summary['entrepreneur'][$trainee->agency]) ? : $this->summary['entrepreneur'][$trainee->agency] = $this->toe;
            $this->summary['entrepreneur'][$trainee->agency]['planned_toe'] += $trainee->no_of_planned_toe;
            $this->summary['entrepreneur'][$trainee->agency]['conducted_toe'] += $trainee->no_of_toe_conducted_activity_report;


            isset($this->summary['msme'][$trainee->agency]) ? : $this->summary['msme'][$trainee->agency] = $this->msme;
            $this->summary['msme'][$trainee->agency]['planned_msme'] += $trainee->estimated_msme_to_be_trained;
            $this->summary['msme'][$trainee->agency]['conducted_msme'] += $trainee->no_msme_trained;}

        
        return $this->summary;
    }

    protected function query()
    {
        return $this->model::query()
            ->select('agency', 'no_of_planned_toe', 'no_of_toe_conducted_activity_report', 'estimated_msme_to_be_trained', 'no_msme_trained');
    }
}
