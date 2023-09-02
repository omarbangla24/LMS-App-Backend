<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Franchise extends Model
{
    use HasFactory;
    protected $fillable = [
        'comp_name',
        'comp_image',
        'comp_email',
        'comp_mobile',
        'comp_url',
        'comp_details',
        'position'
    ];
}
