<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessEvent extends Model
{
    use HasFactory;
    protected $fillable =[
        'title',
        'date',
        'time',
        'location',
        'description',
        'image'
    ];
}
