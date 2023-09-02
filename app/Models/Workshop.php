<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;
    protected $fillable = [
        'topic',
        'date',
        'zoom_id',
        'zoom_link',
        'zoom_pass',
        'meeting_time',
        'upcoming_topic'

    ];
}
