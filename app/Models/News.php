<?php

namespace App\Models;

use App\Models\NewsCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;
    protected $fillable =[
        'image',
        'title',
        'summary',
        'description',
        'news_category_id'
    ];
    public function NewsCategory(): BelongsTo
    {
        return $this-> belongsTo(NewsCategory::class);
    }
}
