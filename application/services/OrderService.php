<?php

namespace App\Services;

class OrderService extends Service
{
    function all()
    {
        $endpoint = 'http://localhost/api.jfc.orders/orders/get';

        $data = [
            'params' => [
                'curdate_value' => 'current_date',
                'order_by'      => 'date_added',
                'sorting'       => 'desc',
                'callcenter_id' => [0],
                'sbu_id'        => 5,
            ],
        ];

        $response = $this->httpRequest($endpoint, $data, API_KEY);

        if (isset($response->success) && $response->success === false) {
            return $response;
        }

        return (object) [
            'success' => $response->status,
            'data'    => $response->data,
        ];
    }

    function create()
    {
        $endpoint = 'http://localhost/api.jfc.orders/orders/add';

        $data = [
            'params' => [
                'type'         => 1,
                'channel_code' => 'Store Channel',
                'order_status' => 17,
                'pwd_src_info' => '{"type":"none","src":[{"id":"654","name":"v","checkName":false,"checkId":false}],"pwd":[{"id":"1234","name":"b","checkName":false,"checkId":false}]}',
                'customer_id'  => 21086313,
                'agent_id'     => 1763442,
                'user_id'      => 1763442,
                'for_special_event' => 1,
                'for_pickup'        => 0,
                'delivery_date'     => '',
                'deliver_to_customer_address' => 10574429,
                'store_id' => 545,
                'sbu_id'   => 5,
                'items' => [
                    [
                        'item_id'    => 5254,
                        'quantity'   => 2,
                        'price'      => 245,
                        'categories' => [85],
                    ]
                ],
                'payment_type' => 1,
                'change_for'   => 500.00,
                'order_type'   => 4,
                'remarks'      => 'This is a test order, Please do not process.',
                'pricing'      => 0,
                'is_advanced'  => 0,
                'nkag_id'      => 0,
                'channel_type' => 'Voice',
                'reference_id' => 0,
                'is_sent'      => 0,
                'delivery_address' => [
                    'house_number'  => '',
                    'unit'          => '',
                    'building'      => 'zxavier Building',
                    'floor'         => '',
                    'street'        => '',
                    'second_street' => '',
                    'barangay'      => '',
                    'subdivision'   => '',
                    'city'          => 'Manila City',
                    'province'      => 'Metro Manila',
                ],
                'display_data' => [
                    'customer_name'  => 'Keven Test',
                    'contact_number' => '639154632597',
                    'contact_number_alternate' => '',
                    'delivery_address' => 10574429,
                    'payment_type'     => 'Cash',
                    'payment_type_id'  => 1,
                    'payment_type_detail' => [
                        'name'       => 'Cash',
                        'tender_id'  => 0,
                        'tender_ref' => '',
                        'type'       => 1,
                        'enable'     => 1,
                    ],
                    'payment_type_list' => [
                        'CASH' => [
                            'name' => 'Cash',
                            'tender_id' => '0',
                            'tender_ref' => '',
                            'type' => '1',
                            'enable' => 1,
                        ],
                        'CHARGE' => [
                            'name'       => 'CHARGE',
                            'tender_id'  => '3',
                            'tender_ref' => 'CHARGE',
                            'type'       => '2',
                            'enable'     => 1,
                        ],
                        'CREDIT' => [
                            'name'       => 'Credit Card',
                            'tender_id'  => '14',
                            'tender_ref' => 'Credit Card',
                            'type'       => '2',
                            'enable'     => 1,
                        ],
                        'CV_50' => [
                            'name'       => 'CASH VOUCHER 50',
                            'tender_id'  => '30',
                            'tender_ref' => 'CASH VOUCHER 50',
                            'type'       => '2',
                            'enable'     => 1,
                        ],
                        'PESO_100' => [
                            'name'       => 'PESO 100',
                            'tender_id'  => '7',
                            'tender_ref' => 'PESO 100',
                            'type'       => '2',
                            'enable'     => 1,
                        ],
                        'PESO_500' => [
                            'name'       => 'PESO 500',
                            'tender_id'  => '9',
                            'tender_ref' => 'PESO 500',
                            'type'       => '2',
                            'enable'     => 1,
                        ],
                        'DELIVERY_GC_100' => [
                            'name'       => 'DELIVERY GC 100',
                            'tender_id'  => '65',
                            'tender_ref' => 'DELIVERY GC 100',
                            'type'       => '2',
                            'enable'     => 1,
                        ],
                        'GREENCARD_HAPPYPLUS_LOAD' => [
                            'name'       => 'GREENCARD/HAPPYPLUS LOAD',
                            'tender_id'  => '5B',
                            'tender_ref' => 'GREENCARD/HAPPYPLUS LOAD',
                            'type'       => '4',
                            'enable'     => 1,
                        ],
                        'DEBIT' => [
                            'name'       => 'Debit Card',
                            'tender_id'  => '79',
                            'tender_ref' => 'Debit Card',
                            'type'       => '5',
                            'enable'     => 1,
                        ],
                        'NKAG' => [
                            'name'       => 'NKAG',
                            'tender_id'  => null,
                            'tender_ref' => null,
                            'type'       => '7',
                            'enable'     => 1,
                        ],
                        'PWAF' => [
                            'name'       => 'Charge-PWAF',
                            'tender_id'  => 'ZA',
                            'tender_ref' => 'CHARGE',
                            'type'       => '8',
                            'enable'     => 1,
                        ],
                        'GC_50' => [
                            'name'       => 'PESO GC 50',
                            'tender_id'  => 'G1',
                            'tender_ref' => 'PESO GC 50',
                            'type'       => '0',
                            'enable'     => 0,
                        ],
                        'GC_100' => [
                            'name'       => 'PESO GC 100',
                            'tender_id'  => 'G0',
                            'tender_ref' => 'PESO GC 100',
                            'type'       => '0',
                            'enable'     => 0,
                        ],
                    ],
                    'credit_card_type'         => '',
                    'happy_plus_card_number'   => '',
                    'gc_serial_number'         => '',
                    'gc_plus_cash_50_qty'      => 0,
                    'gc_plus_cash_100_qty'     => 0,
                    'pwaf_recipient'           => '',
                    'pwaf_company'             => '',
                    'pwaf_cost_center'         => '',
                    'pwaf_department'          => '',
                    'pwaf_reason'              => '',
                    'remarks'                  => 'This is a test order, Please do not process.',
                    'change_for'               => 500.00,
                    'total_cost'               => 490,
                    'added_vat'                => 52.50000000000006,
                    'total_bill'               => 490,
                    'delivery_charge_cut_off'  => 100000,
                    'delivery_charge'          => 0,
                    'embedded_delivery_charge' => 45,
                    'total_delivery_charge'    => 45,
                    'delivery_charge_type'     => 1,
                    'store_summary'            => 'GWV3 - Enhancement',
                    'rta_grid'                 => 0,
                    'nkag_account'             => '',
                    'nkag_service_type'        => '',
                    'nkag_reference_number'    => '',
                    'serving_time'             => 30,
                    'discount'                 => 'none',
                    'contact_for_search'       => '639154632597',
                    'products' => [
                        [
                            'item_id'      => 5254,
                            'quantity'     => 2,
                            'price'        => 245,
                            'categories'   => [85],
                            'is_edited'    => 0,
                            'is_removed'   => 0,
                            'is_added'     => 0,
                            'sub_total'    => 490,
                            'product_name' => 'Double Thick Hawaiian Overload',
                        ]
                    ],
                    'happy_plus' => [
                        [
                            'id'      => 1257,
                            'number'  => 1000102027647074,
                            'date'    => 'November 2021',
                            'remarks' => '',
                        ],
                        [
                            'id'      => 1258,
                            'number'  => 1000102027647074,
                            'date'    => 'April 2021',
                            'remarks' => 'Opala',
                        ],
                        [
                            'id'      => 1259,
                            'number'  => 1000102027647074,
                            'date'    => 'January 2021',
                            'remarks' => '',
                        ],
                        [
                            'id'      => 1260,
                            'number'  => 1000102027647074,
                            'date'    => 'December 2021',
                            'remarks' => '',
                        ],
                        [
                            'id'      => 1262,
                            'number'  => 1000102027647074,
                            'date'    => 'February 2021',
                            'remarks' => 'Test',
                        ],
                    ],
                    'full_address' => 'zxavier Building Manila City Metro Manila',
                ],
            ],
        ];

        $response = $this->httpRequest($endpoint, $data, API_KEY, POST_REQUEST);

        if (isset($response->success) && $response->success === false) {
            return $response;
        }

        return (object) [
            'success' => $response->status,
            'data'    => $response->data,
        ];
    }

    function update($id)
    {
        $endpoint = 'http://localhost/api.jfc.orders/orders/update';

        $data = [
            'params' => [
                'order_id'     => $id,
                'order_status' => 12,
                'is_pwaf'      => 1,
                'order_action_type' => 'order_status_update',
                'is_sent' => 1,
                'event'   => 'update_order',
                'user_id' => 1763457,
            ],
        ];

        $response = $this->httpRequest($endpoint, $data, API_KEY, POST_REQUEST);

        if (isset($response->success) && $response->success === false) {
            return $response;
        }

        return (object) [
            'success' => $response->status,
            'data'    => $response->data,
        ];
    }
}