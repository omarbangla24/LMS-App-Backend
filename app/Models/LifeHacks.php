<?php

namespace App\Models;

use App\Models\LifeHacksCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LifeHacks extends Model
{
    use HasFactory;
    protected $fillable =[
        'life_hacks_text',
        'life_hacks_category_id'
    ];
    public function lifeHacksCategory() : BelongsTo
    {
        return $this->belongsTo(LifeHacksCategory::class);
    }

}
