<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BadgeController extends Controller
{
    /**
     * عرض قائمة الشارات
     */
    public function index()
    {
        $badges = Badge::all();
        $userBadges = Auth::check() ? Auth::user()->badges->pluck('id')->toArray() : [];
        
        return view('badges.index', compact('badges', 'userBadges'));
    }

    /**
     * عرض قائمة شارات المستخدم
     */
    public function userBadges()
    {
        $user = Auth::user();
        $badges = $user->badges()->orderBy('pivot_earned_at', 'desc')->get();
        
        return view('badges.user', compact('user', 'badges'));
    }

    /**
     * عرض تفاصيل شارة معينة
     */
    public function show(Badge $badge)
    {
        $userCount = $badge->users()->count();
        $recentUsers = $badge->users()->orderBy('user_badges.earned_at', 'desc')->take(10)->get();
        
        return view('badges.show', compact('badge', 'userCount', 'recentUsers'));
    }

    /**
     * تحديث حالة الشارة المميزة للمستخدم
     */
    public function toggleFeatured(Request $request, Badge $badge)
    {
        $user = Auth::user();
        $userBadge = $user->badges()->where('badge_id', $badge->id)->first();
        
        if (!$userBadge) {
            return redirect()->back()->with('error', 'لا تملك هذه الشارة!');
        }
        
        $isFeatured = $request->input('is_featured', false);
        $user->badges()->updateExistingPivot($badge->id, ['is_featured' => $isFeatured]);
        
        return redirect()->back()->with('success', 'تم تحديث حالة الشارة بنجاح');
    }
}
