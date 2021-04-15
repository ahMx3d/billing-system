<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Index Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during index for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'card' => [
        'header' => [
            'title' => 'Bill Number #:bill_number',
            'link'  => 'Home',
        ],
        'body' => [
            'title'  => 'Bill Details',
            'print'  => 'Print Bill',
            'export' => 'Export PDF',
            'send'   => 'send Email',
        ]
    ],
    'table' => [
        'header' => [
            'customer_name'   => 'Customer Name',
            'customer_email'  => 'Customer Email',
            'customer_mobile' => 'Customer Mobile',
            'company_name'    => 'Company Name',
            'bill_number'     => 'Bill Number',
            'bill_date'       => 'Bill Date',

            'product_name'     => 'Product Name',
            'unit'             => 'Unit',
            'quantity'         => 'Quantity',
            'unit_price'       => 'Unit Price',
            'product_subtotal' => 'Product Subtotal',

            'empty' => 'No Products Found',

            'sub_total'      => 'Sub Total',
            'discount_value' => 'Discount Value',
            'vat_value'      => 'Vat Value',
            'shipping_value' => 'Shipping Value',
            'total_due'      => 'Total Due',
        ],
        'body' => [
            'unit' => [
                'options' => [
                    'piece'    => 'Piece',
                    'gram'     => 'Gram',
                    'kilogram' => 'Kilogram',
                ],
                'placeholder' => 'سعر الوحده',
            ],
        ],
        'confirm' => 'Are You Sure?'
    ],

];
