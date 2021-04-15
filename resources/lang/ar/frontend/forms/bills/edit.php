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
            'title' => 'فاتوره رقم #:bill_number',
            'link'  => 'الصفحة الرئيسية',
        ],
    ],

    'customer' => [
        'name'        => 'الإسم',
        'email'       => 'البريد الإلكترونى',
        'mobile'      => 'رقم الهاتف',
        'placeholder' => [
            'name'   => 'إسم العميل',
            'email'  => 'بريد العميل الإلكترونى',
            'mobile' => 'رقم هاتف العميل',
        ]
    ],
    'company' => [
        'name'        => 'إسم الشركه',
        'placeholder' => [
            'name' => 'الإسم',
        ],
    ],
    'bill' => [
        'number'      => 'رقم الفاتوره',
        'date'        => 'تاريخ الفاتوره',
        'placeholder' => [
            'number' => 'الرقم',
            'date'   => 'التاريخ',
        ]
    ],
    'product' => [
        'total-due' => 'الاجمالي المستحق',
        'shipping' => 'التوصيل',
        'vat'      => 'ضريبة القيمة المضافة (٥%)',
        'discount' => [
            'name' => 'الخصم',
            'type' => [
                'fixed'      => 'بالجنيه المصرى',
                'percentage' => 'بالنسبه المئويه',
            ]
        ],
        'btn'      => [
            'add' => 'أضف منتج آخر',
        ],
        'placeholder' => [
            'name' => 'إسم المنتج'
        ],
        'name' => 'إسم المنتج',
        'unit' => [
            'name'    => 'إسم الوحده',
            'price'   => 'سعر الوحده',
            'options' => [
                'piece' => 'قطعة',
                'gram'  => 'جرام',
                'kilogram'  => 'كيلو جرام ',
            ],
            'placeholder' => 'سعر الوحده',
        ],
        'quantity' => [
            'name'        => 'الكميه',
            'placeholder' => 'الكميه',
        ],
        'subtotal' => [
            'name'        => 'المجموع الفرعي',
            'placeholder' => 'المجموع الفرعي',
        ],
    ],
    'form' => [
        'submit' => 'احفظ الفاتورة',
    ],
    'table' => [
        'header' => [
            'empty' => 'لا توجد منتجات'
        ],
    ],
];
