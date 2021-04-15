<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = [
        'unit_value',
        'translated_unit',
    ];

    /**
     * Get the bill that owns the details.
     */
    public function bill()
    {
        return $this->belongsTo(Bill::class, 'bill_id', 'id');
    }

    /**
     * Get the selection unit value option.
     *
     * @return string
     */
    public function getUnitValueAttribute(): string
    {
        $unitValue = $this->unit;
        return match ($unitValue) {
            'kilogram' => 'kg',
            'piece'    => 'p',
            'gram'     => 'g',
            default    => $unitValue,
        };
    }

    /**
     * Get the translated unit value.
     *
     * @return string
     */
    public function getTranslatedUnitAttribute(): string
    {
        $unitValue = $this->unit;
        return match ($unitValue) {
            'kilogram', 'kg' , 'KG' => __('frontend/bills/show.table.body.unit.options.kilogram'),
            'piece'   , 'p' ,  'P'  => __('frontend/bills/show.table.body.unit.options.piece'),
            'gram'    , 'g' ,  'G'  => __('frontend/bills/show.table.body.unit.options.gram'),
            default                 => $unitValue ,
        };
    }
}
