<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;

class Badge extends Model
{
    use HasFactory;

    /**
     * الحقول القابلة للتعبئة
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'icon',
        'color',
        'required_points',
        'achievement_type',
        'achievement_count',
    ];

    /**
     * علاقة المستخدمين الذين حصلوا على هذه الشارة
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_badges')
            ->withPivot('earned_at', 'is_featured')
            ->withTimestamps();
    }

    /**
     * التحقق إذا كان المستخدم مؤهلاً للحصول على هذه الشارة
     *
     * @param User $user المستخدم
     * @return bool
     */
    public function isEligible(User $user): bool
    {
        // التحقق استناداً إلى النقاط الإجمالية
        if ($this->required_points > 0) {
            $totalPoints = $user->getTotalPoints();
            if ($totalPoints < $this->required_points) {
                return false;
            }
        }

        // التحقق استناداً إلى نوع الإنجاز وعدده
        if ($this->achievement_type && $this->achievement_count) {
            $achievementCount = 0;

            switch ($this->achievement_type) {
                case 'participation':
                    $achievementCount = $user->participationRequests()->whereNotNull('approved_at')->count();
                    break;
                case 'donation':
                    $achievementCount = $user->donations()->count();
                    break;
                case 'referral':
                    // يمكن إضافة منطق حساب الإحالات هنا
                    break;
                // يمكن إضافة المزيد من أنواع الإنجازات هنا
            }

            if ($achievementCount < $this->achievement_count) {
                return false;
            }
        }

        return true;
    }
}
