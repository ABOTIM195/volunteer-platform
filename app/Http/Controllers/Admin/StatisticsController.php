<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Comment;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    /**
     * عرض صفحة الإحصائيات
     */
    public function index()
    {
        // إحصائيات المستخدمين
        $totalUsers = User::count();
        $regularUsers = User::where('type', 'regular')->count();
        $teamUsers = User::where('type', 'team')->count();
        $organizationUsers = User::where('type', 'organization')->count();
        
        // إحصائيات الحملات
        $totalCampaigns = Campaign::count();
        $volunteerCampaigns = Campaign::where('type', 'volunteer')->count();
        $helpCampaigns = Campaign::where('type', 'help')->count();
        $activeCampaigns = Campaign::where('status', 'active')->count();
        
        // إحصائيات التبرعات
        $totalDonations = Donation::count();
        $totalDonationAmount = Donation::sum('amount');
        
        // إحصائيات التعليقات
        $totalComments = Comment::count();
        
        return view('admin.statistics.index', compact(
            'totalUsers', 'regularUsers', 'teamUsers', 'organizationUsers',
            'totalCampaigns', 'volunteerCampaigns', 'helpCampaigns', 'activeCampaigns',
            'totalDonations', 'totalDonationAmount', 'totalComments'
        ));
    }
}