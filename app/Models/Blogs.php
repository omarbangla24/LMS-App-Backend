<?php

namespace App\Models;

use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blogs extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'title',
        'summary',
        'description',
        'blog_category_id'
    ];
    public function BlogCategory(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class);
    }
}
