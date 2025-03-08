<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    /**
     * عرض لوحة المتصدرين
     */
    public function index()
    {
        // الحصول على المستخدمين المصنفين حسب مجموع النقاط
        $topUsers = User::selectRaw('users.id, users.name, users.email, users.type, users.avatar, SUM(points.amount) as total_points')
            ->leftJoin('points', 'users.id', '=', 'points.user_id')
            ->groupBy('users.id', 'users.name', 'users.email', 'users.type', 'users.avatar')
            ->orderByRaw('total_points DESC')
            ->take(50)
            ->get();
            
        // تحديد ترتيب المستخدم الحالي إذا كان مسجلاً
        $currentUserRank = null;
        if (Auth::check()) {
            $currentUser = Auth::user();
            $currentUserRank = $currentUser->getRank();
        }
        
        return view('leaderboard.index', compact('topUsers', 'currentUserRank'));
    }
    
    /**
     * عرض لوحة المتصدرين للتطوع
     */
    public function participation()
    {
        // الحصول على المستخدمين المصنفين حسب عدد المشاركات في الحملات
        $topUsers = User::selectRaw('users.id, users.name, users.email, users.type, users.avatar, COUNT(participation_requests.id) as participation_count, MAX(participation_requests.created_at) as last_participation')
            ->leftJoin('participation_requests', function ($join) {
                $join->on('users.id', '=', 'participation_requests.user_id')
                    ->where('participation_requests.status', '=', 'approved');
            })
            ->groupBy('users.id', 'users.name', 'users.email', 'users.type', 'users.avatar')
            ->orderByRaw('participation_count DESC')
            ->take(50)
            ->get();
            
        // تحديد ترتيب المستخدم الحالي
        $currentUserRank = null;
        $currentUserParticipationCount = 0;
        
        if (Auth::check()) {
            $currentUser = Auth::user();
            
            // حساب ترتيب المستخدم الحالي
            $userRanks = $topUsers->pluck('id')->toArray();
            $currentUserPosition = array_search($currentUser->id, $userRanks);
            $currentUserRank = $currentUserPosition !== false ? $currentUserPosition + 1 : '-';
            
            // عدد مشاركات المستخدم الحالي
            $currentUserParticipationCount = $currentUser->participationRequests()
                ->where('status', '=', 'approved')
                ->count();
        }
            
        return view('leaderboard.participation', compact('topUsers', 'currentUserRank', 'currentUserParticipationCount'));
    }
    
    /**
     * عرض لوحة المتصدرين للتبرعات
     */
    public function donation()
    {
        // الحصول على المستخدمين المصنفين حسب إجمالي مبالغ التبرع
        $topUsers = User::selectRaw('users.id, users.name, users.email, users.type, users.avatar, SUM(donations.amount) as total_donation_amount, COUNT(donations.id) as donation_count')
            ->leftJoin('donations', 'users.id', '=', 'donations.user_id')
            ->groupBy('users.id', 'users.name', 'users.email', 'users.type', 'users.avatar')
            ->orderByRaw('total_donation_amount DESC')
            ->take(50)
            ->get();
            
        // تحديد ترتيب المستخدم الحالي
        $currentUserRank = null;
        $currentUserTotalDonation = 0;
        $currentUserDonationCount = 0;
        
        if (Auth::check()) {
            $currentUser = Auth::user();
            
            // حساب ترتيب المستخدم الحالي
            $userRanks = $topUsers->pluck('id')->toArray();
            $currentUserPosition = array_search($currentUser->id, $userRanks);
            $currentUserRank = $currentUserPosition !== false ? $currentUserPosition + 1 : '-';
            
            // إجمالي تبرعات المستخدم الحالي
            $currentUserTotalDonation = $currentUser->donations()->sum('amount');
            $currentUserDonationCount = $currentUser->donations()->count();
        }
            
        return view('leaderboard.donation', compact('topUsers', 'currentUserRank', 'currentUserTotalDonation', 'currentUserDonationCount'));
    }
}
