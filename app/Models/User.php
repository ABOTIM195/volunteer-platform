<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * User types
     */
    const TYPE_REGULAR = 'regular';
    const TYPE_TEAM = 'team';
    const TYPE_ORGANIZATION = 'organization';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'avatar', // إضافة حقل الصورة الشخصية
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * علاقة المستخدم بطلبات المشاركة في الفرص التطوعية
     */
    public function participations()
    {
        return $this->hasMany(ParticipationRequest::class, 'user_id');
    }
    
    /**
     * Check if user is a regular user
     *
     * @return bool
     */
    public function isRegular(): bool
    {
        return $this->type === self::TYPE_REGULAR;
    }

    /**
     * Check if user is a volunteer team
     *
     * @return bool
     */
    public function isTeam(): bool
    {
        return $this->type === self::TYPE_TEAM;
    }

    /**
     * Check if user is an organization
     *
     * @return bool
     */
    public function isOrganization(): bool
    {
        return $this->type === self::TYPE_ORGANIZATION;
    }

    /**
     * Get campaigns created by this user
     */
    public function campaigns(): HasMany
    {
        return $this->hasMany(Campaign::class, 'creator_id');
    }

    /**
     * Get donations made by this user
     */
    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * Get comments made by this user
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get likes made by this user
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Get campaign participation requests made by this user
     */
    public function participationRequests(): HasMany
    {
        return $this->hasMany(ParticipationRequest::class);
    }
}
