<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pdf extends Model
{
    use HasFactory;
    protected $fillable =[
        'title',
        'pdf_url',
        'course_id'
    ];
   public function Course():BelongsTo
   {
        return $this->belongsTo(Course::class);
   }
}
