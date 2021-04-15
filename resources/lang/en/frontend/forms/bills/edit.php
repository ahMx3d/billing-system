<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'card' => [
        'head' => [
            'title' => 'Bill Number #:bill_number',
            'link'  => 'Home Page'
        ],
    ],

    'customer' => [
        'name'        => 'Name',
        'email'       => 'Email',
        'mobile'      => 'Mobile',
        'placeholder' => [
            'name'   => 'Customer Name',
            'email'  => 'Customer Email',
            'mobile' => 'Customer Mobile',
        ]
    ],
    'company' => [
        'name'        => 'Company Name',
        'placeholder' => [
            'name' => 'Name',
        ]
    ],
    'bill' => [
        'number'      => 'Bill Number',
        'date'        => 'Bill Date',
        'placeholder' => [
            'number' => 'Number',
            'date'   => 'Date',
        ]
    ],
    'product' => [
        'total-due' => 'Total Due',
        'shipping'  => 'Shipping',
        'vat'       => 'VAT(5%)',
        'discount'  => [
            'name' => 'Discount',
            'type' => [
                'fixed'      => 'EG',
                'percentage' => 'Percentage',
            ]
        ],
        'btn'      => [
            'add' => 'Add Another Product',
        ],
        'placeholder' => [
            'name' => 'Product Name'
        ],
        'name' => 'Product Name',
        'unit' => [
            'name'    => 'Unit',
            'price'   => 'Unit Price',
            'options' => [
                'piece' => 'Piece',
                'gram'  => 'Gram',
                'kilogram'  => 'KiloGram',
            ],
            'placeholder' => 'Unit Price',
        ],
        'quantity' => [
            'name'        => 'Quantity',
            'placeholder' => 'Quantity',
        ],
        'subtotal' => [
            'name'        => 'Subtotal',
            'placeholder' => 'Subtotal',
        ],
    ],
    'form' => [
        'submit' => 'Save Bill',
    ],
    'table' => [
        'header' => [
            'empty' => 'No Products Found'
        ],
    ],
];
