<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Panel;
use App\Models\Idea;
use App\Models\Note;
use App\Models\CouponUsage;
use App\Models\FileRequest;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable implements FilamentUser, JWTSubject // Implement JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'usertype',
        'email_verified_at',
        'password',
        'mobile_no',
        'token',
        'address',
        'usertype',
        'age',
        'profile_image_path',
        'otp',
        'ref_code',
        'professions_id',
        'bkash_mobile',
        'trans_id',
        'trans_date',
        'expire_date',
        'amount',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole(['Admin', 'Moderator']);
    }
    public function Course(): HasMany
    {
        return $this->hasMany(User::class);
    }
    public function Note(): HasMany
    {
        return $this->hasMany(Note::class);
    }
    public function couponUsages()
    {
        return $this->hasMany(CouponUsage::class);
    }
    public function fileRequests(): HasMany
    {
        return $this->hasMany(FileRequest::class);
    }

    public function likedIdeas(): BelongsToMany
    {
        return $this->belongsToMany(Idea::class, 'user_liked_ideas')->withTimestamps();
    }

    public function hasLiked(Idea $idea): bool
    {
        return $this->likedIdeas->contains($idea);
    }
}
