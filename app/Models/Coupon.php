<?php

namespace App\Models;

use App\Models\CouponUsage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'discount'
    ];
    public function usages():HasMany
    {
        return $this->hasMany(CouponUsage::class);
    }
}
