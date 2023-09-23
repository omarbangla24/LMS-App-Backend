<?php

namespace App\Models;

use App\Models\User;
use App\Models\Coupon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CouponUsage extends Model
{
    use HasFactory;
    protected $fillable = [
        'coupon_id',
        'user_id',
    ];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function coupon():BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }
}
