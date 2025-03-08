<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Point extends Model
{
    use HasFactory;

    /**
     * الحقول القابلة للتعبئة
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'amount',
        'action_type',
        'action_id',
        'description',
    ];

    /**
     * الأنواع الصالحة للأنشطة
     *
     * @var array
     */
    public static $validActionTypes = [
        'participation' => 'مشاركة في حملة',
        'donation' => 'تبرع',
        'comment' => 'تعليق',
        'like' => 'إعجاب',
        'referral' => 'دعوة صديق',
        'login' => 'تسجيل دخول',
    ];

    /**
     * النقاط المخصصة لكل نوع نشاط
     *
     * @var array
     */
    public static $pointsPerAction = [
        'participation' => 50,
        'donation' => 20,
        'comment' => 5,
        'like' => 2,
        'referral' => 30,
        'login' => 1,
    ];

    /**
     * علاقة المستخدم
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * زيادة نقاط المستخدم عند قيامه بنشاط
     *
     * @param User $user المستخدم
     * @param string $actionType نوع النشاط
     * @param int|null $actionId معرف النشاط
     * @param string|null $description وصف إضافي
     * @return Point
     */
    public static function award(User $user, string $actionType, ?int $actionId = null, ?string $description = null): Point
    {
        if (!array_key_exists($actionType, self::$validActionTypes)) {
            throw new \InvalidArgumentException("نوع النشاط '{$actionType}' غير صالح");
        }

        $amount = self::$pointsPerAction[$actionType] ?? 0;

        return self::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'action_type' => $actionType,
            'action_id' => $actionId,
            'description' => $description ?? self::$validActionTypes[$actionType],
        ]);
    }
}
