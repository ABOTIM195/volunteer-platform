<?php

namespace App\Services;

use App\Models\User;
use App\Models\Point;
use App\Models\Badge;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PointService
{
    /**
     * منح نقاط للمستخدم والتحقق من الشارات المستحقة
     *
     * @param User $user المستخدم
     * @param string $actionType نوع النشاط
     * @param int|null $actionId معرف النشاط
     * @param string|null $description وصف إضافي للنشاط
     * @return array ['point' => Point, 'new_badges' => Badge[]]
     */
    public function awardPoints(User $user, string $actionType, ?int $actionId = null, ?string $description = null): array
    {
        // بدء المعاملة لضمان تكامل البيانات
        DB::beginTransaction();
        
        try {
            // منح النقاط
            $point = Point::award($user, $actionType, $actionId, $description);
            
            // التحقق من الشارات المستحقة
            $newBadges = $user->checkEligibleBadges();
            
            // تأكيد المعاملة
            DB::commit();
            
            return [
                'point' => $point,
                'new_badges' => $newBadges
            ];
        } catch (\Exception $e) {
            // التراجع عن المعاملة في حالة حدوث خطأ
            DB::rollBack();
            Log::error('Error awarding points: ' . $e->getMessage());
            
            throw $e;
        }
    }
    
    /**
     * حساب ترتيب مستخدم معين
     *
     * @param User $user المستخدم
     * @return int ترتيب المستخدم
     */
    public function calculateUserRank(User $user): int
    {
        return $user->getRank();
    }
    
    /**
     * الحصول على أفضل المستخدمين حسب النقاط
     *
     * @param int $limit عدد المستخدمين المراد عرضهم
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTopUsers(int $limit = 10)
    {
        return User::selectRaw('users.*, SUM(points.amount) as total_points')
            ->leftJoin('points', 'users.id', '=', 'points.user_id')
            ->groupBy('users.id')
            ->orderByRaw('total_points DESC')
            ->take($limit)
            ->get();
    }
    
    /**
     * تهيئة الشارات الافتراضية في النظام
     *
     * @return void
     */
    public function initializeDefaultBadges(): void
    {
        // تعريف الشارات الافتراضية
        $defaultBadges = [
            [
                'name' => 'المتطوع المبتدئ',
                'description' => 'أكمل مشاركتك الأولى في حملة تطوعية',
                'icon' => 'fa-seedling',
                'color' => '#28a745',
                'achievement_type' => 'participation',
                'achievement_count' => 1
            ],
            [
                'name' => 'المتطوع النشط',
                'description' => 'شارك في 5 حملات تطوعية',
                'icon' => 'fa-hands-helping',
                'color' => '#17a2b8',
                'achievement_type' => 'participation',
                'achievement_count' => 5
            ],
            [
                'name' => 'المتطوع المحترف',
                'description' => 'شارك في 10 حملات تطوعية',
                'icon' => 'fa-award',
                'color' => '#ffc107',
                'achievement_type' => 'participation',
                'achievement_count' => 10
            ],
            [
                'name' => 'المتبرع الكريم',
                'description' => 'قدم تبرعًا لإحدى الحملات',
                'icon' => 'fa-hand-holding-heart',
                'color' => '#dc3545',
                'achievement_type' => 'donation',
                'achievement_count' => 1
            ],
            [
                'name' => 'المعلق النشط',
                'description' => 'أضف 5 تعليقات على الحملات',
                'icon' => 'fa-comments',
                'color' => '#6f42c1',
                'required_points' => 25
            ],
            [
                'name' => '100 نقطة',
                'description' => 'حصل على 100 نقطة من الأنشطة المختلفة',
                'icon' => 'fa-star',
                'color' => '#fd7e14',
                'required_points' => 100
            ],
            [
                'name' => '500 نقطة',
                'description' => 'حصل على 500 نقطة من الأنشطة المختلفة',
                'icon' => 'fa-certificate',
                'color' => '#20c997',
                'required_points' => 500
            ],
        ];
        
        // إنشاء الشارات إذا لم تكن موجودة بالفعل
        foreach ($defaultBadges as $badgeData) {
            Badge::firstOrCreate(
                ['name' => $badgeData['name']],
                $badgeData
            );
        }
    }
}
