<?php

namespace App\Models;

use App\Models\FileRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'path',
        // Add other fields as needed
    ];

    public function fileRequests(): HasMany
    {
        return $this->hasMany(FileRequest::class);
    }
}
