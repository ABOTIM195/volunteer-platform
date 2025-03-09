<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $query = Campaign::with('user', 'category');

        // البحث
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // التصفية حسب الحالة
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // التصفية حسب الفئة
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $campaigns = $query->orderBy('created_at', 'desc')->paginate(15);
        $categories = Category::all();

        return view('admin.campaigns.index', compact('campaigns', 'categories'));
    }

    public function show(Campaign $campaign)
    {
        $campaign->load(['user', 'category', 'comments.user', 'participationRequests.user']);
        return view('admin.campaigns.show', compact('campaign'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.campaigns.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'category_id' => ['required', 'exists:categories,id'],
            'status' => ['required', 'in:draft,active,completed,cancelled'],
            'image' => ['nullable', 'image', 'max:2048'],
            'target_volunteers' => ['nullable', 'integer', 'min:1'],
            'target_amount' => ['nullable', 'numeric', 'min:0'],
        ]);

        $campaign = new Campaign($validated);
        $campaign->user_id = $request->user_id ?? auth()->id();
        $campaign->slug = Str::slug($validated['title']) . '-' . Str::random(5);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('campaigns', 'public');
            $campaign->image = $path;
        }

        $campaign->save();

        return redirect()->route('admin.campaigns.show', $campaign)
            ->with('success', 'تم إنشاء الحملة بنجاح.');
    }

    public function update(Request $request, Campaign $campaign)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'category_id' => ['required', 'exists:categories,id'],
            'status' => ['required', 'in:draft,active,completed,cancelled'],
            'image' => ['nullable', 'image', 'max:2048'],
            'target_volunteers' => ['nullable', 'integer', 'min:1'],
            'target_amount' => ['nullable', 'numeric', 'min:0'],
        ]);

        $campaign->fill($validated);

        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا وجدت
            if ($campaign->image) {
                Storage::disk('public')->delete($campaign->image);
            }
            
            $path = $request->file('image')->store('campaigns', 'public');
            $campaign->image = $path;
        }

        $campaign->save();

        return redirect()->route('admin.campaigns.show', $campaign)
            ->with('success', 'تم تحديث الحملة بنجاح.');
    }

    public function destroy(Campaign $campaign)
    {
        // حذف الصورة إذا وجدت
        if ($campaign->image) {
            Storage::disk('public')->delete($campaign->image);
        }

        $campaign->delete();

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'تم حذف الحملة بنجاح.');
    }
}