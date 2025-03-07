<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\ParticipationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParticipationRequestController extends Controller
{
    /**
     * Display a listing of participation requests for the organization.
     */
    public function index()
    {
        // Get campaigns created by the current user (organization/team)
        $campaigns = Auth::user()->campaigns()->pluck('id');
        
        // Get all participation requests for these campaigns
        $participationRequests = ParticipationRequest::whereIn('campaign_id', $campaigns)
            ->with(['user', 'campaign'])
            ->latest()
            ->paginate(15);
        
        return view('participation-requests.index', compact('participationRequests'));
    }

    /**
     * Display a listing of the user's participation requests.
     */
    public function userRequests()
    {
        $requests = Auth::user()->participationRequests()
            ->with('campaign.creator')
            ->latest()
            ->paginate(10);
        
        return view('participation-requests.user', compact('requests'));
    }

    /**
     * Store a newly created participation request in storage.
     */
    public function store(Request $request, Campaign $campaign)
    {
        // Check if the campaign is a help campaign (organizations only)
        if (!$campaign->isHelpCampaign()) {
            return redirect()->route('campaigns.show', $campaign)
                ->with('error', 'لا يمكن تقديم طلب مشاركة إلا في حملات المساعدة');
        }
        
        // Check if user already has a pending request for this campaign
        $existingRequest = ParticipationRequest::where('user_id', Auth::id())
            ->where('campaign_id', $campaign->id)
            ->first();
            
        if ($existingRequest) {
            return redirect()->route('campaigns.show', $campaign)
                ->with('error', 'لديك بالفعل طلب مشاركة لهذه الحملة');
        }
        
        // Validate the request
        $validated = $request->validate([
            'message' => 'nullable|string|max:500',
        ]);
        
        // Add user_id and campaign_id
        $validated['user_id'] = Auth::id();
        $validated['campaign_id'] = $campaign->id;
        $validated['status'] = ParticipationRequest::STATUS_PENDING;
        
        // Create the participation request
        ParticipationRequest::create($validated);
        
        return redirect()->route('campaigns.show', $campaign)
            ->with('success', 'تم إرسال طلب المشاركة بنجاح، سيتم الرد عليك قريباً');
    }

    /**
     * Update the status of a participation request.
     */
    public function updateStatus(Request $request, ParticipationRequest $participationRequest)
    {
        // Check if the current user is the campaign creator
        if (Auth::id() !== $participationRequest->campaign->creator_id) {
            return redirect()->route('participation-requests.index')
                ->with('error', 'غير مصرح لك بتغيير حالة هذا الطلب');
        }
        
        // Validate the request
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);
        
        // Update the participation request status
        $participationRequest->update([
            'status' => $validated['status'],
        ]);
        
        $statusMessage = $validated['status'] === 'approved' ? 'تمت الموافقة على' : 'تم رفض';
        
        return redirect()->route('participation-requests.index')
            ->with('success', $statusMessage . ' طلب المشاركة بنجاح');
    }

    /**
     * Display the specified participation request.
     */
    public function show(ParticipationRequest $participationRequest)
    {
        // Check if the user is authorized to view this request
        if (Auth::id() !== $participationRequest->user_id && Auth::id() !== $participationRequest->campaign->creator_id) {
            return redirect()->route('participation-requests.index')
                ->with('error', 'غير مصرح لك بعرض هذا الطلب');
        }

        return view('participation-requests.show', compact('participationRequest'));
    }

    /**
     * Approve a participation request.
     */
    public function approve(Request $request, ParticipationRequest $participationRequest)
    {
        // Check if the current user is the campaign creator
        if (Auth::id() !== $participationRequest->campaign->creator_id) {
            return redirect()->route('participation-requests.index')
                ->with('error', 'غير مصرح لك بالموافقة على هذا الطلب');
        }
        
        // Update the participation request status
        $participationRequest->update([
            'status' => ParticipationRequest::STATUS_APPROVED,
            'response_message' => $request->input('response_message'),
        ]);
        
        return redirect()->route('participation-requests.show', $participationRequest)
            ->with('success', 'تمت الموافقة على طلب المشاركة بنجاح');
    }

    /**
     * Reject a participation request.
     */
    public function reject(Request $request, ParticipationRequest $participationRequest)
    {
        // Check if the current user is the campaign creator
        if (Auth::id() !== $participationRequest->campaign->creator_id) {
            return redirect()->route('participation-requests.index')
                ->with('error', 'غير مصرح لك برفض هذا الطلب');
        }
        
        // Update the participation request status
        $participationRequest->update([
            'status' => ParticipationRequest::STATUS_REJECTED,
            'response_message' => $request->input('response_message'),
        ]);
        
        return redirect()->route('participation-requests.show', $participationRequest)
            ->with('success', 'تم رفض طلب المشاركة');
    }

    /**
     * Remove the specified participation request from storage.
     */
    public function destroy(ParticipationRequest $participationRequest)
    {
        // Check if the user is the owner of the request and its status is pending
        if (Auth::id() !== $participationRequest->user_id || $participationRequest->status !== ParticipationRequest::STATUS_PENDING) {
            return redirect()->route('participation-requests.user')
                ->with('error', 'لا يمكنك سحب هذا الطلب');
        }

        // Delete the participation request
        $participationRequest->delete();

        return redirect()->route('participation-requests.user')
            ->with('success', 'تم سحب طلب المشاركة بنجاح');
    }
}
