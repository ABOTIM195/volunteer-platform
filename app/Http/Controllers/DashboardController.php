<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Campaign;
use App\Models\ParticipationRequest;
use App\Models\Badge;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // إحصائيات للمستخدم
        $stats = [
            'campaigns_count' => Campaign::where('user_id', $user->id)->count(),
            'participation_count' => ParticipationRequest::where('user_id', $user->id)->count(),
            'badges_count' => $user->badges()->count(),
        ];
        
        // آخر الحملات
        $latestCampaigns = Campaign::latest()->take(3)->get();
        
        return view('dashboard', compact('user', 'stats', 'latestCampaigns'));
    }
}