<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['discount_text'];

    /**
     * Get the details for the bill.
     */
    public function details()
    {
        return $this->hasMany(BillDetail::class, 'bill_id', 'id');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'id';
    }

    /**
     * Get the discount value text.
     *
     * @return string
     */
    public function getDiscountTextAttribute(): string
    {
        return $this->discount_type === 'fixed' ? "{$this->discount_value}" : "{$this->discount_value} %";
    }
}
