<?php

namespace App\Models;

use App\Models\LifeHacksCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LifeHacks extends Model
{
    use HasFactory;
    protected $fillable =[
        'life_hacks_text',
        'life_hacks_cat_id'
    ];
    public function lifeHacksCategory()
    {
        return $this->belongsTo(LifeHacksCategory::class);
    }

}
