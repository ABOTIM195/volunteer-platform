<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'phone', // Keep only one instance of 'phone'
        'city',
        'bio',
        'type',
        'avatar', // إضافة حقل الصورة الشخصية
        'description', // نبذة تعريفية
        'website', // الموقع الإلكتروني
        // 'phone', // Removed duplicate phone entry
        'twitter', // حساب تويتر
        'instagram', // حساب انستجرام
        'profile_photo_path', // Add this for profile photo storage
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

    /**
     * الحصول على نقاط المستخدم
     */
    public function points(): HasMany
    {
        return $this->hasMany(Point::class);
    }

    /**
     * الحصول على شارات المستخدم
     */
    public function badges(): BelongsToMany
    {
        return $this->belongsToMany(Badge::class, 'user_badges')
            ->withPivot('earned_at', 'is_featured')
            ->withTimestamps();
    }

    /**
     * الحصول على مجموع نقاط المستخدم
     *
     * @return int
     */
    public function getTotalPoints(): int
    {
        return $this->points()->sum('amount');
    }

    /**
     * الحصول على ترتيب المستخدم بين جميع المستخدمين
     *
     * @return int
     */
    public function getRank(): int
    {
        $usersRanked = User::selectRaw('users.id, users.name, SUM(points.amount) as total_points')
            ->leftJoin('points', 'users.id', '=', 'points.user_id')
            ->groupBy('users.id', 'users.name')
            ->orderByRaw('total_points DESC')
            ->get();

        $rankList = $usersRanked->pluck('id')->toArray();
        $position = array_search($this->id, $rankList);

        return $position !== false ? $position + 1 : $usersRanked->count();
    }

    /**
     * منح المستخدم شارة
     *
     * @param Badge $badge الشارة المراد منحها
     * @param bool $featured هل هي شارة مميزة
     * @return UserBadge
     */
    public function awardBadge(Badge $badge, bool $featured = false): UserBadge
    {
        // التحقق مما إذا كان المستخدم يملك الشارة بالفعل
        $existingBadge = UserBadge::where('user_id', $this->id)
            ->where('badge_id', $badge->id)
            ->first();

        if ($existingBadge) {
            return $existingBadge;
        }

        // منح الشارة
        return UserBadge::create([
            'user_id' => $this->id,
            'badge_id' => $badge->id,
            'earned_at' => now(),
            'is_featured' => $featured,
        ]);
    }

    /**
     * فحص الشارات المستحقة وإضافتها للمستخدم
     *
     * @return array الشارات الجديدة التي تم منحها
     */
    public function checkEligibleBadges(): array
    {
        $newBadges = [];
        $allBadges = Badge::all();

        foreach ($allBadges as $badge) {
            // تخطي الشارات التي حصل عليها المستخدم بالفعل
            if ($this->badges()->where('badge_id', $badge->id)->exists()) {
                continue;
            }

            // التحقق من الأهلية
            if ($badge->isEligible($this)) {
                $userBadge = $this->awardBadge($badge);
                $newBadges[] = $badge;
            }
        }

        return $newBadges;
    }
    
    /**
     * الحصول على الشارات البارزة للمستخدم
     *
     * @param int $limit عدد الشارات المراد عرضها
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFeaturedBadges(int $limit = 5)
    {
        return $this->badges()
            ->with('badge')  // تحميل علاقة الشارة بشكل مسبق
            ->orderByDesc('user_badges.earned_at')
            ->take($limit)
            ->get();
    }
}
