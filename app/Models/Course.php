<?php

namespace App\Models;

use App\Models\Pdf;
use App\Models\User;
use App\Models\CourseCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    protected $fillable =[
        'course_category_id',
        'user_id',
        'title',
        'image',
        'description',
        'duration',
        'status'
    ];
    public function CourseCategory(): BelongsTo
    {
        return $this->belongsTo(CourseCategory::class);
    }
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function Lesson():HasMany
    {
        return $this->hasMany(Lesson::class, 'course_id', 'id');
    }
    public function Pdf():HasMany
    {
        return $this->hasMany(Pdf::class, 'course_id', 'id');
    }
}
