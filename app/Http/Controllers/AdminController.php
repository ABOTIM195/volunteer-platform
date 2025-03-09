<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\Campaign;
use App\Models\Comment;
use App\Models\Donation;
use App\Models\ParticipationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * عرض لوحة تحكم المدير
     */
    public function dashboard()
    {
        // إحصائيات سريعة
        $stats = [
            'users_count' => User::count(),
            'campaigns_count' => Campaign::count(),
            'donations_sum' => Donation::sum('amount'),
            'participation_requests_count' => ParticipationRequest::count(),
        ];
        
        // آخر المستخدمين المسجلين
        $latestUsers = User::latest()->take(5)->get();
        
        // آخر الحملات
        $latestCampaigns = Campaign::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('stats', 'latestUsers', 'latestCampaigns'));
    }
    
    /**
     * عرض قائمة المستخدمين
     */
    public function users(Request $request)
    {
        $users = User::query();
        
        // البحث
        if ($request->has('search')) {
            $search = $request->search;
            $users->where(function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        // الفلترة حسب النوع
        if ($request->has('type') && $request->type) {
            $users->where('type', $request->type);
        }
        
        $users = $users->paginate(15);
        
        return view('admin.users.index', compact('users'));
    }
    
    /**
     * عرض تفاصيل مستخدم
     */
    public function showUser(User $user)
    {
        return view('admin.users.show', compact('user'));
    }
    
    /**
     * تحديث بيانات مستخدم
     */
    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'type' => 'required|in:regular,team,organization',
            'is_admin' => 'boolean',
        ]);
        
        $user->update($validated);
        
        return redirect()->route('admin.users.show', $user)
            ->with('success', 'تم تحديث بيانات المستخدم بنجاح');
    }
    
    /**
     * حذف مستخدم
     */
    public function deleteUser(User $user)
    {
        // التحقق من عدم حذف المدير لنفسه
        if ($user->id === auth()->id()) {
            return back()->with('error', 'لا يمكنك حذف حسابك الخاص من هنا');
        }
        
        $user->delete();
        
        return redirect()->route('admin.users.index')
            ->with('success', 'تم حذف المستخدم بنجاح');
    }
    
    /**
     * عرض قائمة الحملات
     */
    public function campaigns(Request $request)
    {
        $campaigns = Campaign::query();
        
        // البحث
        if ($request->has('search')) {
            $search = $request->search;
            $campaigns->where('title', 'like', "%{$search}%");
        }
        
        // الفلترة حسب الحالة
        if ($request->has('status') && $request->status) {
            $campaigns->where('status', $request->status);
        }
        
        $campaigns = $campaigns->with('creator')->paginate(10);
        
        return view('admin.campaigns.index', compact('campaigns'));
    }
    
    /**
     * عرض تفاصيل حملة
     */
    public function showCampaign(Campaign $campaign)
    {
        $campaign->load(['creator', 'comments.user', 'participationRequests.user']);
        return view('admin.campaigns.show', compact('campaign'));
    }
    
    /**
     * تحديث حملة
     */
    public function updateCampaign(Request $request, Campaign $campaign)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'target_amount' => 'nullable|numeric|min:0',
            'end_date' => 'nullable|date|after:today',
            'status' => 'required|in:draft,active,completed,cancelled',
            'featured' => 'boolean',
        ]);
        
        $campaign->update($validated);
        
        return redirect()->route('admin.campaigns.show', $campaign)
            ->with('success', 'تم تحديث الحملة بنجاح');
    }
    
    /**
     * حذف حملة
     */
    public function deleteCampaign(Campaign $campaign)
    {
        $campaign->delete();
        
        return redirect()->route('admin.campaigns.index')
            ->with('success', 'تم حذف الحملة بنجاح');
    }
    
    /**
     * عرض قائمة الشارات
     */
    public function badges(Request $request)
    {
        $badges = Badge::query();
        
        // البحث
        if ($request->has('search')) {
            $search = $request->search;
            $badges->where('name', 'like', "%{$search}%");
        }
        
        $badges = $badges->paginate(15);
        
        return view('admin.badges.index', compact('badges'));
    }
    
    /**
     * عرض نموذج إنشاء شارة جديدة
     */
    public function createBadge()
    {
        return view('admin.badges.create');
    }
    
    /**
     * حفظ شارة جديدة
     */
    public function storeBadge(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|max:2048',
            'requirements' => 'required|string',
            'points' => 'required|integer|min:0',
        ]);
        
        // معالجة الصورة
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('badges', 'public');
            $validated['image_path'] = $path;
        }
        
        Badge::create($validated);
        
        return redirect()->route('admin.badges.index')
            ->with('success', 'تم إنشاء الشارة بنجاح');
    }
    
    /**
     * عرض نموذج تعديل شارة
     */
    public function editBadge(Badge $badge)
    {
        return view('admin.badges.edit', compact('badge'));
    }
    
    /**
     * تحديث شارة
     */
    public function updateBadge(Request $request, Badge $badge)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'requirements' => 'required|string',
            'points' => 'required|integer|min:0',
        ]);
        
        // معالجة الصورة
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا وجدت
            if ($badge->image_path) {
                Storage::disk('public')->delete($badge->image_path);
            }
            
            $path = $request->file('image')->store('badges', 'public');
            $validated['image_path'] = $path;
        }
        
        $badge->update($validated);
        
        return redirect()->route('admin.badges.index')
            ->with('success', 'تم تحديث الشارة بنجاح');
    }
    
    /**
     * حذف شارة
     */
    public function deleteBadge(Badge $badge)
    {
        // حذف الصورة المرتبطة بالشارة
        if ($badge->image_path) {
            Storage::disk('public')->delete($badge->image_path);
        }
        
        $badge->delete();
        
        return redirect()->route('admin.badges.index')
            ->with('success', 'تم حذف الشارة بنجاح');
    }
    
    /**
     * عرض قائمة التعليقات
     */
    public function comments(Request $request)
    {
        $comments = Comment::query();
        
        // البحث
        if ($request->has('search')) {
            $search = $request->search;
            $comments->where('content', 'like', "%{$search}%");
        }
        
        $comments = $comments->with(['user', 'campaign'])->latest()->paginate(20);
        
        return view('admin.comments.index', compact('comments'));
    }
    
    /**
     * حذف تعليق
     */
    public function deleteComment(Comment $comment)
    {
        $comment->delete();
        
        return redirect()->route('admin.comments.index')
            ->with('success', 'تم حذف التعليق بنجاح');
    }
    
    /**
     * عرض إحصائيات الموقع
     */
    public function statistics()
    {
        // إحصائيات المستخدمين
        $userStats = [
            'total' => User::count(),
            'by_type' => User::select('type', DB::raw('count(*) as count'))
                ->groupBy('type')
                ->pluck('count', 'type')
                ->toArray(),
            'growth' => User::select(
                    DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                    DB::raw('count(*) as count')
                )
                ->where('created_at', '>=', now()->subMonths(6))
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('count', 'month')
                ->toArray(),
        ];
        
        // إحصائيات الحملات
        $campaignStats = [
            'total' => Campaign::count(),
            'by_status' => Campaign::select('status', DB::raw('count(*) as count'))
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray(),
            'growth' => Campaign::select(
                    DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                    DB::raw('count(*) as count')
                )
                ->where('created_at', '>=', now()->subMonths(6))
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('count', 'month')
                ->toArray(),
        ];
        
        // إحصائيات التبرعات
        $donationStats = [
            'total_amount' => Donation::sum('amount'),
            'count' => Donation::count(),
            'average' => Donation::avg('amount'),
            'by_month' => Donation::select(
                    DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                    DB::raw('sum(amount) as total')
                )
                ->where('created_at', '>=', now()->subMonths(6))
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('total', 'month')
                ->toArray(),
        ];
        
        return view('admin.statistics', compact('userStats', 'campaignStats', 'donationStats'));
    }
    
    /**
     * عرض إعدادات الموقع
     */
    public function settings()
    {
        // استرجاع الإعدادات من قاعدة البيانات أو ملف التكوين
        $settings = [
            'site_name' => config('app.name'),
            'site_description' => config('app.description', ''),
            'contact_email' => config('app.contact_email', ''),
            'enable_registration' => config('app.enable_registration', true),
            'enable_donations' => config('app.enable_donations', true),
            'maintenance_mode' => app()->isDownForMaintenance(),
        ];
        
        return view('admin.settings', compact('settings'));
    }
    
    /**
     * تحديث إعدادات الموقع
     */
    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'contact_email' => 'required|email',
            'enable_registration' => 'boolean',
            'enable_donations' => 'boolean',
            'maintenance_mode' => 'boolean',
        ]);
        
        // تحديث الإعدادات (هذا مثال، قد تحتاج لتنفيذ آلية حفظ الإعدادات الخاصة بك)
        // يمكن استخدام حزمة مثل spatie/laravel-settings لإدارة الإعدادات
        
        // تحديث اسم التطبيق في ملف .env
        $this->updateEnvFile('APP_NAME', '"' . $validated['site_name'] . '"');
        
        // إدارة وضع الصيانة
        if ($validated['maintenance_mode'] && !app()->isDownForMaintenance()) {
            \Artisan::call('down');
        } elseif (!$validated['maintenance_mode'] && app()->isDownForMaintenance()) {
            \Artisan::call('up');
        }
        
        return redirect()->route('admin.settings')
            ->with('success', 'تم تحديث إعدادات الموقع بنجاح');
    }
    
        /**
     * تحديث ملف .env
     */
    private function updateEnvFile($key, $value)
    {
        $path = base_path('.env');
        
        if (file_exists($path)) {
            $content = file_get_contents($path);
            
            // إذا كان المفتاح موجودًا، قم بتحديثه
            if (strpos($content, "{$key}=") !== false) {
                $content = preg_replace("/{$key}=.*/", "{$key}={$value}", $content);
            } else {
                // إذا لم يكن المفتاح موجودًا، قم بإضافته
                $content .= PHP_EOL . "{$key}={$value}";
            }
            
            file_put_contents($path, $content);
        }
    }
}