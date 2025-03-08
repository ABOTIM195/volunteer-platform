<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    /**
     * عرض لوحة المتصدرين
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $userType = $request->input('user_type');
        
        // الحصول على المستخدمين المصنفين حسب مجموع النقاط
        $query = User::selectRaw('users.id, users.name, users.email, users.type, users.avatar, SUM(points.amount) as total_points')
            ->leftJoin('points', 'users.id', '=', 'points.user_id');
            
        // إضافة شرط البحث إذا تم تقديمه
        if ($search) {
            $query->where('users.name', 'like', '%' . $search . '%');
        }
        
        // إضافة شرط تصفية نوع المستخدم إذا تم تقديمه
        if ($userType) {
            $query->where('users.type', $userType);
        }
        
        $topUsers = $query->groupBy('users.id', 'users.name', 'users.email', 'users.type', 'users.avatar')
            ->orderByRaw('total_points DESC')
            ->take(50)
            ->get();
            
        // تحديد ترتيب المستخدم الحالي إذا كان مسجلاً
        $currentUserRank = null;
        if (Auth::check()) {
            $currentUser = Auth::user();
            $currentUserRank = $currentUser->getRank();
        }
        
        return view('leaderboard.index', compact('topUsers', 'currentUserRank', 'search', 'userType'));
    }
    
    /**
     * عرض لوحة المتصدرين للتطوع
     */
    public function participation(Request $request)
    {
        $search = $request->input('search');
        $userType = $request->input('user_type');
        
        // الحصول على المستخدمين المصنفين حسب عدد المشاركات في الحملات
        $query = User::selectRaw('users.id, users.name, users.email, users.type, users.avatar, COUNT(participation_requests.id) as participation_count, MAX(participation_requests.created_at) as last_participation')
            ->leftJoin('participation_requests', function ($join) {
                $join->on('users.id', '=', 'participation_requests.user_id')
                    ->where('participation_requests.status', '=', 'approved');
            });
            
        // إضافة شرط البحث إذا تم تقديمه
        if ($search) {
            $query->where('users.name', 'like', '%' . $search . '%');
        }
        
        // إضافة شرط تصفية نوع المستخدم إذا تم تقديمه
        if ($userType) {
            $query->where('users.type', $userType);
        }
        
        $topUsers = $query->groupBy('users.id', 'users.name', 'users.email', 'users.type', 'users.avatar')
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
            
        return view('leaderboard.participation', compact('topUsers', 'currentUserRank', 'currentUserParticipationCount', 'search', 'userType'));
    }
    
    /**
     * عرض لوحة المتصدرين للتبرعات
     */
    public function donation(Request $request)
    {
        $search = $request->input('search');
        $userType = $request->input('user_type');
        
        // الحصول على المستخدمين المصنفين حسب إجمالي مبالغ التبرع
        $query = User::selectRaw('users.id, users.name, users.email, users.type, users.avatar, SUM(donations.amount) as total_donation_amount, COUNT(donations.id) as donation_count')
            ->leftJoin('donations', 'users.id', '=', 'donations.user_id');
            
        // إضافة شرط البحث إذا تم تقديمه
        if ($search) {
            $query->where('users.name', 'like', '%' . $search . '%');
        }
        
        // إضافة شرط تصفية نوع المستخدم إذا تم تقديمه
        if ($userType) {
            $query->where('users.type', $userType);
        }
        
        $topUsers = $query->groupBy('users.id', 'users.name', 'users.email', 'users.type', 'users.avatar')
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
            
        return view('leaderboard.donation', compact('topUsers', 'currentUserRank', 'currentUserTotalDonation', 'currentUserDonationCount', 'search', 'userType'));
    }
    
    /**
     * البحث عن مستخدم في لوحة المتصدرين
     */
    public function search(Request $request)
    {
        $search = $request->input('search');
        $userType = $request->input('user_type');
        $type = $request->input('type', 'points'); // points, participation, donation
        
        if ($search || $userType) {
            switch ($type) {
                case 'participation':
                    return $this->participation($request);
                case 'donation':
                    return $this->donation($request);
                default:
                    return $this->index($request);
            }
        }
        
        // إذا لم يتم تقديم مصطلح بحث أو نوع مستخدم، إعادة توجيه إلى لوحة المتصدرين الرئيسية
        return redirect()->route('leaderboard.index');
    }
}
