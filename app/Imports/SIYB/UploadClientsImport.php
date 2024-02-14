<?php

namespace App\Imports\SIYB;

use App\Models\SIYB\Agency;
use App\Models\SIYB\Client;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UploadClientsImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        unset($rows[0]);

        $data = $rows->toArray();

        foreach($data as $key => $row) {
            $this->store($row);
        }
    }

    /**
     * @param  mixed  $row
     * @return void
     */
    public function store(mixed $row): void
    {
        $agency = Agency::whereBatchCode($row[1])->first();

        $client = Client::firstOrCreate([
            'email' => $row[4],
        ],
        [
            'last_name' => $row[5],
            'first_name' => $row[6],
            'suffix' => $row[8],
            'middle_name' => $row[7],
            'agency_id' => $agency->id,
            'gender' => $row[9],
            'age' => $row[11],
            'socmed' => $row[13],
            'mobile_number' => $row[14],
            'high_education' => $row[15],
            'address' => $row[10]
        ]);

        $client->responses()->create([
            'timestamp' => Date::excelToDateTimeObject(intval($row[0]))->format('Y-m-d H:i:s'),
            'metadata' => [
                'rank_your_abilities_following_areas_filipino' => $row[16],
                'rank_your_abilities_following_areas_english' => $row[17],
                'rank_your_abilities_following_areas_calculation' => $row[18],
                'attended_any_skills_training_related_to_your_business' => $row[19],
                'q1_if_yes_please_specify' => $row[20],
                'q1_long_was_the_training' => $row[21],
                'attended_any_business_management_training_before' => $row[22],
                'q2_if_yes_please_specify' => $row[23],
                'q2_long_was_the_training' => $row[24],
                'digital_devices_do_you_have' => $row[25],
                'level_of_internet_access_do_you_currently_have' => $row[26],
                'select_the_applicable_option' => $row[27],
                'explain_briefly_why_the_applicant_wants_to_start_a_business' => $row[28],
                'many_years_have_you_worked_as_an_employee_or_worker_or_entrepreneur' => $row[29],
                'have_you_run_different_businesses_before_considering_starting_a_new_business' => $row[30],
                'q1_if_yes_above_please_describe' => $row[31],
                'do_you_have_a_concrete_and_feasible_business_idea' => $row[32],
                'q2_if_yes_above_please_describe' => $row[33],
                'do_you_have_work_experience_related_to_the_new_business_you_intend_to_start' => $row[34],
                'q3_if_yes_above_please_describe'  => $row[35],
                'do_you_have_a_business_plan' => $row[36],
                'q4_what_would_you_like_to_do_with_it' => $row[37],
                'for_starting_the_business_what_is_the_main_source_of_finance_you_plan_to_use' => $row[38],
                'have_you_sold_anything_online' => $row[39],
                'q5_if_yes_above_please_describe' => $row[40],
                'in_your_new_business_to_be_started_do_you_plan_to_sell_online' => $row[41],
                'in_your_new_business_to_be_started_do_you_plan_to_us_ewallets_and_digital_financial_services' => $row[42],
                'in_your_new_business_to_be_started_do_you_plan_to_use_digital_tools_apps_to_manage_the_business_operations' => $row[43],
                'name_of_business' => $row[44],
                'when_did_you_start_the_business' => $row[45],
                'if_more_than_one_year_please_indicate_first_commercial_month' => $row[46],
                'what_is_your_position_in_the_business' => $row[47],
                'describe_your_business_activity' => $row[48],
                'what_is_your_current_line_of_business' => $row[49],
                'what_type_of_business_is_it' => $row[50],
                'is_your_business_registered' => $row[51],
                'what_is_the_value_of_total_investment_in_your_business' => $row[52],
                'what_is_the_average_monthly_sales_of_your_business' => $row[53],
                'how_much_is_the_monthly_net_profit_of_the_business' => $row[54],
                'how_many_people_do_you_employ' => $row[55],
                'how_many_are_women' => $row[56],
                'marketing_activities' => $row[57],
                'calculated' => $row[58],
                'make_a_cash_flow_plan' => $row[59],
                'make_a_sales_and_cost_plan' => $row[60],
                'record_keeping_system' => $row[61],
                'digitalized_record_keeping_system_or_app' => $row[62],
                'buying_and_stock_control' => $row[63],
                'digitalized_buying_and_stock_control_system_app' => $row[64],
                'any_form_of_human_resource_management' => $row[65],
                'using_social_media_and_messenger_platforms_to_stay_visible_and_communicate_with_clients' => $row[66],
                'having_a_website' => $row[67],
                'promoting_the_business_with_digital_marketing_and_branding' => $row[68],
                'selling_online_via_social_media_platforms' => $row[69],
                'selling_online_via_marketplaces' => $row[70],
                'selling_online_via_business_website' => $row[71],
                'using_payment_gateways_and_or_processors_to_sell_online' => $row[72],
                'pos_cashier' => $row[73],
                'having_structured_shipping_delivering_systems' => $row[74],
                'having_defined_policies_concerning_digital_ethics_trust_and_security' => $row[75],
                'sources_of_finance_of_your_business_over_the_last_one_year' => $row[76],
                'do_you_have_more_than_one_business' => $row[77],
                'plans_for_your_existing_business_in_the_near_future' => $row[78],
                'expect_to_learn_during_the_training' => $row[79],
            ]
        ]);
    }
}
