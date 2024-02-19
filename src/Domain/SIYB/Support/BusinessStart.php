<?php

namespace Domain\SIYB\Support;

trait BusinessStart
{
    protected array $businessStartData = [
        'concrete_feasible_business_idea' => [
            'Yes' => 0,
            'No' => 0,
        ],
        'do_you_have_a_business_plan' => [
            'Yes' => 0,
            'No' => 0,
        ],
        'sold_anything_online' => [
            'Yes' => 0,
            'No' => 0,
        ],
        'sell_online' => [
            'Yes' => 0,
            'No' => 0,
        ],
        'digital_financial_services' => [
            'Yes' => 0,
            'No' => 0,
        ],
        'digital_tools_apps' => [
            'Yes' => 0,
            'No' => 0,
        ],
    ];


    protected function businessStart($latestResponse, $businessStart): array
    {
        $answer_concrete = $latestResponse['do_you_have_a_concrete_and_feasible_business_idea'] === 'Yes'? 'Yes' : 'No';
        $businessStart['concrete_feasible_business_idea'][$answer_concrete] += 1;

        $answer_business_plan = $latestResponse['do_you_have_a_business_plan'] === 'Yes'? 'Yes' : 'No';
        $businessStart['do_you_have_a_business_plan'][$answer_business_plan] += 1;

        $answer_sold_anything_online = $latestResponse['have_you_sold_anything_online'] === 'Yes'? 'Yes' : 'No';
        $businessStart['sold_anything_online'][$answer_sold_anything_online] += 1;

        $answer_sell_online = $latestResponse['in_your_new_business_to_be_started_do_you_plan_to_sell_online'] === 'Yes'? 'Yes' : 'No';
        $businessStart['sell_online'][$answer_sell_online] += 1;

        $answer_digital_financial_services = $latestResponse['in_your_new_business_to_be_started_do_you_plan_to_us_ewallets_and_digital_financial_services'] === 'Yes'? 'Yes' : 'No';
        $businessStart['digital_financial_services'][$answer_digital_financial_services] += 1;

        $answer_digital_tools_apps =  $latestResponse['in_your_new_business_to_be_started_do_you_plan_to_use_digital_tools_apps_to_manage_the_business_operations'] === 'Yes'? 'Yes' : 'No';
        $businessStart['digital_tools_apps'][$answer_digital_tools_apps] += 1;

        return $businessStart;
    }
}
