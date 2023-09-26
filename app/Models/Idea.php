<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Idea extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'idea_date',
        'like_count'
    ];


    public function likedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_liked_ideas')->withTimestamps();
    }

    public function like(User $user)
    {
        if (!$this->likedByUsers->contains($user)) {
            $this->likedByUsers()->attach($user);
        }
    }

    public function unlike(User $user)
    {
        if ($this->likedByUsers->contains($user)) {
            $this->likedByUsers()->detach($user);
        }
    }

    public function hasLiked(User $user)
    {
        return $this->likedByUsers->contains($user);
    }
}
