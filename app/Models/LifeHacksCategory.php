<?php

namespace App\Models;

use App\Models\LifeHacks;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LifeHacksCategory extends Model
{
    use HasFactory;
    protected $casts = [
        'is_premium' => 'boolean',
    ];
    protected $fillable = [
        'life_cat_title',
        'life_cat_img',
        'is_premium'
    ];

    public function LifeHacks(): HasMany
    {
        return $this-> hasMany(LifeHacks::class);
    }
}
