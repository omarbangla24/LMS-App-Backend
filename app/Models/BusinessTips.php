<?php

namespace App\Models;

use App\Models\BusinessTipsCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessTips extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'business_tips_category_id'
    ];
    public function BusinessTipsCategory(): BelongsTo
    {
        return $this->belongsTo(BusinessTipsCategory::class);
    }
}
