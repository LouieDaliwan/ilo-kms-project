<?php

namespace Domain\SIYB\Support;


trait BusinessOwners
{
    protected array $businessOwnersData = [
        'current_line_business' => [
            'Retail' => 0,
            'Wholesale' => 0,
            'Manufacturing' => 0,
            'Service Operation' => 0,
            'Agriculture related' => 0,
            'Others' => 0,
        ],
        'type_of_business' => [
            'Sole Proprietorship' => 0,
            'Partnership' => 0,
            'Joint Stock Company' => 0,
            'Cooperative' => 0,
            'Others' => 0,
        ],
        'business_registered' => [
            'Yes' => 0,
            'No' => 0,
        ],
        'digitalized_record' => [
            'Regularly' => 0,
            'Sometimes' => 0,
            'Seldom' => 0,
            'N/A or Never' => 0,
        ],
        'digitalized_buying' => [
            'Regularly' => 0,
            'Sometimes' => 0,
            'Seldom' => 0,
            'N/A or Never' => 0,
        ],
        'socmed' => [
            'Regularly' => 0,
            'Sometimes' => 0,
            'Seldom' => 0,
            'N/A or Never' => 0,
        ],
        'having_a_website' =>[
            'Regularly' => 0,
            'Sometimes' => 0,
            'Seldom' => 0,
            'N/A or Never' => 0,
        ],
        'promoting' =>[
            'Regularly' => 0,
            'Sometimes' => 0,
            'Seldom' => 0,
            'N/A or Never' => 0,
        ],
        'selling_socmed' =>[
            'Regularly' => 0,
            'Sometimes' => 0,
            'Seldom' => 0,
            'N/A or Never' => 0,
        ],
        'selling_marketplace' => [
            'Regularly' => 0,
            'Sometimes' => 0,
            'Seldom' => 0,
            'N/A or Never' => 0,
        ],
        'selling_website' => [
            'Regularly' => 0,
            'Sometimes' => 0,
            'Seldom' => 0,
            'N/A or Never' => 0,
        ],
        'using_payment' => [
            'Regularly' => 0,
            'Sometimes' => 0,
            'Seldom' => 0,
            'N/A or Never' => 0,
        ],
        'having_defined_policies' => [
            'Regularly' => 0,
            'Sometimes' => 0,
            'Seldom' => 0,
            'N/A or Never' => 0,
        ],
        'plans_existing_future_business' => [
            'Remain with / strengthen same business' => 0,
            'Start new business, replacing old one' => 0,
            'Start new business activities in addition to existing one' => 0,
            'Don’t know' => 0,
        ]
    ];

    protected function businessOwners($latestResponse, $businessOwnersData): array
    {
        if(!is_null($latestResponse['what_is_your_current_line_of_business'])) {
            $itemLineBusiness = in_array($latestResponse['what_is_your_current_line_of_business'], $businessOwnersData['current_line_business']) ? $latestResponse['what_is_your_current_line_of_business'] : 'Others';
            $businessOwnersData['current_line_business'][$itemLineBusiness] += 1;
        }

        if(!is_null($latestResponse['what_is_your_current_line_of_business'])) {
            $itemLineBusiness = in_array($latestResponse['what_is_your_current_line_of_business'], $businessOwnersData['type_of_business']) ? $latestResponse['what_type_of_business_is_it'] : 'Others';
            $businessOwnersData['type_of_business'][$itemLineBusiness] += 1;
        }

        if(!is_null($latestResponse['is_your_business_registered'])) {
            $businessOwnersData['business_registered'][$latestResponse['is_your_business_registered']] += 1;
        }

        if(!is_null($latestResponse['digitalized_record_keeping_system_or_app'])) {
            $businessOwnersData['digitalized_record'][$latestResponse['digitalized_record_keeping_system_or_app']] += 1;
        }

        if(!is_null($latestResponse['digitalized_buying_and_stock_control_system_app'])) {
            $businessOwnersData['digitalized_buying'][$latestResponse['digitalized_buying_and_stock_control_system_app']] += 1;
        }

        if(!is_null($latestResponse['using_social_media_and_messenger_platforms_to_stay_visible_and_communicate_with_clients'])) {
            $businessOwnersData['socmed'][$latestResponse['using_social_media_and_messenger_platforms_to_stay_visible_and_communicate_with_clients']] += 1;
        }

        if(!is_null($latestResponse['having_a_website'])) {
            $businessOwnersData['having_a_website'][$latestResponse['having_a_website']] += 1;
        }

        if(!is_null($latestResponse['promoting_the_business_with_digital_marketing_and_branding'])) {
            $businessOwnersData['promoting'][$latestResponse['promoting_the_business_with_digital_marketing_and_branding']] += 1;
        }

        if(!is_null($latestResponse['selling_online_via_social_media_platforms'])) {
            $businessOwnersData['selling_socmed'][$latestResponse['selling_online_via_social_media_platforms']] += 1;
        }

        if(!is_null($latestResponse['selling_online_via_marketplaces'])) {
            $businessOwnersData['selling_marketplace'][$latestResponse['selling_online_via_marketplaces']] += 1;
        }

        if(!is_null($latestResponse['selling_online_via_business_website'])) {
            $businessOwnersData['selling_website'][$latestResponse['selling_online_via_business_website']] += 1;
        }

        if(!is_null($latestResponse['using_payment_gateways_and_or_processors_to_sell_online'])) {
            $businessOwnersData['using_payment'][$latestResponse['using_payment_gateways_and_or_processors_to_sell_online']] += 1;
        }

        if(!is_null($latestResponse['having_defined_policies_concerning_digital_ethics_trust_and_security'])) {
            $businessOwnersData['having_defined_policies'][$latestResponse['having_defined_policies_concerning_digital_ethics_trust_and_security']] += 1;
        }

        if(!is_null($latestResponse['plans_for_your_existing_business_in_the_near_future'])) {
            $businessOwnersData['plans_existing_future_business'][$latestResponse['plans_for_your_existing_business_in_the_near_future']] += 1;
        }

        return $businessOwnersData;
    }
}
