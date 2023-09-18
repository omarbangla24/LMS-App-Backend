<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;
    protected $fillable =[
        'course_id',
        'user_id',
        'note_text',
    ];
    public function Course():BelongsTo
    {
         return $this->belongsTo(Course::class);
    }
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
