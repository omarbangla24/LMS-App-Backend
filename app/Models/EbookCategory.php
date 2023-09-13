<?php

namespace App\Models;

use App\Models\Ebook;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EbookCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'is_premium'
    ];
    public function Ebook() : HasMany
    {
        return $this->hasMany(Ebook::class);
    }
}
