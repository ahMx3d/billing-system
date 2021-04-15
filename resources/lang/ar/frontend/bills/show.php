<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Show Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during show for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'card' => [
        'header' => [
            'title' => 'فاتوره رقم #:bill_number',
            'link'  => 'الصفحة الرئيسية',
        ],
        'body' => [
            'title'  => 'تفاصيل الفاتوره',
            'print'  => 'طباعة الفاتوره',
            'export' => 'تصدير ملف PDF',
            'send'   => 'ارسل بريد الكتروني',
        ]
    ],
    'table' => [
        'header' => [
            'customer_name'   => 'إسم العميل',
            'customer_email'  => 'الإيميل',
            'customer_mobile' => 'رقم الهاتف',
            'company_name'    => 'إسم الشركه',
            'bill_number'     => 'رقم الفاتوره',
            'bill_date'       => 'تاريخ الفاتوره',

            'product_name'     => 'إسم المنتج',
            'unit'             => 'الوحده',
            'quantity'         => 'الكميه',
            'unit_price'       => 'سعر الوحده',
            'product_subtotal' => 'المجموع الفرعي',

            'empty' => 'لا توجد منتجات',

            'sub_total'      => 'المجموع الفرعي',
            'discount_value' => 'قيمة الخصم',
            'vat_value'      => 'ضريبة القيمه المضافه',
            'shipping_value' => 'قيمة الشحن',
            'total_due'      => 'الاجمالي المستحق',
        ],
        'body' => [
            'unit' => [
                'options' => [
                    'piece'    => 'قطعة',
                    'gram'     => 'جرام',
                    'kilogram' => 'كيلو جرام ',
                ],
                'placeholder' => 'سعر الوحده',
            ],
        ],
        'confirm' => 'هل انت متأكد؟'
    ],

];
