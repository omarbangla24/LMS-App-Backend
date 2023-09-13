<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NewsCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image'
    ];
    public function News(): HasMany
    {
        return $this->hasMany(News::class);
    }
}
