<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Bill;
use Illuminate\Database\Seeder;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'product_name'  => 'طاولة كمبيوتر كبيرة',
                'unit'          => 'piece',
                'quantity'      => '2',
                'unit_price'    => '560',
                'row_sub_total' => '1120',
            ],
            [
                'product_name'  => 'طاولة كمبيوتر صغيرة',
                'unit'          => 'piece',
                'quantity'      => '1',
                'unit_price'    => '220',
                'row_sub_total' => '220',
            ],
            [
                'product_name'  => 'كمبيوتر محمول',
                'unit'          => 'piece',
                'quantity'      => '1',
                'unit_price'    => '4500',
                'row_sub_total' => '4500',
            ]
        ];

        $bills = Bill::factory(15)->create();
        $bills->each(function($bill, $key)use($items){
            $bill->details()->createMany($items);
        });
    }
}
