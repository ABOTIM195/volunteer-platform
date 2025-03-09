<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\User;
use App\Models\Comment;
use App\Models\ParticipationRequest;
use App\Models\Donation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // إحصائيات عامة
        $stats = [
            'users_count' => User::count(),
            'campaigns_count' => Campaign::count(),
            'comments_count' => Comment::count(),
            'participation_requests_count' => ParticipationRequest::count() ?? 0,
            'donations_count' => Donation::count() ?? 0,
            'donations_sum' => Donation::sum('amount') ?? 0,
        ];

        // المستخدمين الجدد (آخر 7 أيام)
        $latestUsers = User::where('created_at', '>=', now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // الحملات الجديدة (آخر 7 أيام)
        $latestCampaigns = Campaign::where('created_at', '>=', now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'latestUsers',
            'latestCampaigns'
        ));
    }
}