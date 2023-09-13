<?php

namespace App\Models;

use App\Models\Blogs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'is_premium'
    ];
    public function Blogs(): HasMany
    {
        return $this->hasMany(Blogs::class);
    }

}
