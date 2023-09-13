<?php

namespace App\Models;

use App\Models\EbookCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ebook extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'ebook',
        'image',
        'ebook_category_id'
    ];
    public function EbookCategory() : BelongsTo
    {
        return $this->belongsTo(EbookCategory::class);
    }
}
