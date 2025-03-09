<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CampaignController extends Controller
{
    /**
     * Display a listing of campaigns.
     */
    public function index(Request $request)
    {
        $type = $request->input('type');
        $query = Campaign::with('creator')->where('status', 'active');
        
        if ($type) {
            $query->where('type', $type);
        }
        
        $campaigns = $query->latest()->paginate(12);
        
        return view('welcome', compact('campaigns'));
    }
 
    /**
     * Show the form for creating a new campaign.
     */
    public function create()
    {
        // Only teams and organizations can create campaigns
        if (Auth::user()->isRegular()) {
            return redirect()->route('campaigns.index')
                ->with('error', 'فقط الفرق التطوعية والمنظمات يمكنها إنشاء حملات تطوعية');
        }

        return view('campaigns.create');
    }

    /**
     * Store a newly created campaign in storage.
     */
    public function store(Request $request)
    {
        // Only teams and organizations can create campaigns
        if (Auth::user()->isRegular()) {
            return redirect()->route('campaigns.index')
                ->with('error', 'فقط الفرق التطوعية والمنظمات يمكنها إنشاء حملات تطوعية');
        }

        // Validate the request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => [
                'required',
                Rule::in([Campaign::TYPE_VOLUNTEER, Campaign::TYPE_HELP]),
            ],
            'target_amount' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'image' => 'nullable|image|max:2048', // Max 2MB
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('campaigns', 'public');
            $validated['image'] = $imagePath;
        }

        // Add creator id
        $validated['creator_id'] = Auth::id();
        
        // Set current amount to 0
        $validated['current_amount'] = 0;

        // Create the campaign
        $campaign = Campaign::create($validated);

        return redirect()->route('campaigns.show', $campaign)
            ->with('success', 'تم إنشاء الحملة بنجاح');
    }

    /**
     * Display the specified campaign.
     */
    public function show(Campaign $campaign)
    {
        $campaign->load(['creator', 'comments.user', 'donations.user']);
        $userLiked = false;
        $userRequested = false;
        
        if (Auth::check()) {
            $userLiked = $campaign->likes()->where('user_id', Auth::id())->exists();
            $userRequested = $campaign->participationRequests()->where('user_id', Auth::id())->exists();
        }
        
        return view('campaigns.show', compact('campaign', 'userLiked', 'userRequested'));
    }

    /**
     * Show the form for editing the specified campaign.
     */
    public function edit(Campaign $campaign)
    {
        // Check if the user is the creator of the campaign
        if (Auth::id() !== $campaign->creator_id) {
            return redirect()->route('campaigns.show', $campaign)
                ->with('error', 'غير مصرح لك بتعديل هذه الحملة');
        }

        return view('campaigns.edit', compact('campaign'));
    }

    /**
     * Update the specified campaign in storage.
     */
    public function update(Request $request, Campaign $campaign)
    {
        // التحقق من أن المستخدم هو منشئ الحملة
        if (auth()->id() !== $campaign->creator_id) {
            abort(403, 'غير مصرح لك بتعديل هذه الحملة');
        }
    
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:volunteer,help',
            'target_amount' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'skills' => 'nullable|string|max:255',
        ]);
    
        // التعامل مع الصورة
        if ($request->hasFile('image')) {
            // إذا كانت هناك صورة قديمة، قم بحذفها
            if ($campaign->image) {
                Storage::disk('public')->delete($campaign->image);
            }
            $validated['image'] = $request->file('image')->store('campaigns', 'public');
        } elseif ($request->has('remove_image') && $request->remove_image) {
            // إذا تم طلب إزالة الصورة
            if ($campaign->image) {
                Storage::disk('public')->delete($campaign->image);
            }
            $validated['image'] = null;
        }
    
        $campaign->update($validated);
    
        return redirect()->route('campaigns.show', $campaign)
            ->with('success', 'تم تحديث الحملة بنجاح');
    }

    /**
     * Remove the specified campaign from storage.
     */
    public function destroy(Campaign $campaign)
    {
        // Check if the user is the creator of the campaign
        if (Auth::id() !== $campaign->creator_id) {
            return redirect()->route('campaigns.show', $campaign)
                ->with('error', 'غير مصرح لك بحذف هذه الحملة');
        }

        // Delete the campaign image if exists
        if ($campaign->image) {
            Storage::disk('public')->delete($campaign->image);
        }

        // Delete the campaign
        $campaign->delete();

        return redirect()->route('campaigns.index')
            ->with('success', 'تم حذف الحملة بنجاح');
    }

    /**
     * Show my campaigns.
     */
    public function myCampaigns()
    {
        $campaigns = Auth::user()->campaigns()->latest()->paginate(12);
        
        return view('campaigns.my-campaigns', compact('campaigns'));
    }
}
