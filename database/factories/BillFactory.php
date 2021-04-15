<?php

namespace Database\Factories;

use App\Models\Bill;
use Illuminate\Database\Eloquent\Factories\Factory;

class BillFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bill::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fakerAr = \Faker\Factory::create('ar_SA');
        return [
            'customer_name'   => $fakerAr->name,
            'customer_email'  => $fakerAr->email,
            'customer_mobile' => $this->numGenerator(rand(10, 14)),
            'company_name'    => $fakerAr->name,
            'bill_number'     => $this->numGenerator(8),
            'bill_date'       => now()->subDays(rand(1, 20)),
            'sub_total'       => '5840',
            'discount_type'   => 'fixed',
            'discount_value'  => '0',
            'vat_value'       => '292',
            'shipping_value'  => '100',
            'total_due'       => '6232',
        ];
    }

    /**
     * Generate random number.
     *
     * @param int $strLen
     * @return string
     */
    private function numGenerator(int $strLen = 14): string
    {
        $chars     = '0123456789';
        $charsLen  = \strlen($chars);
        $randomStr = '';

        for ($i = 1; $i < $strLen; $i++) {
            $randomChar = $chars[\mt_rand(0, $charsLen - 1)];
            $randomStr .= $randomChar;
        }

        return $randomStr;
    }
}
