<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable =[
        'course_id',
        'title',
        'position',
        'image',
        'description',
        'video_link',
        'is_premium',
    ];
    public function Course():BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
