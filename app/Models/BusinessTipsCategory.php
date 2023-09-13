<?php

namespace App\Models;

use App\Models\BusinessTips;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessTipsCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'is_premium'
    ];
    public function BusinessTips(): HasMany
    {
        return $this->hasMany(BusinessTips::class);
    }
}
