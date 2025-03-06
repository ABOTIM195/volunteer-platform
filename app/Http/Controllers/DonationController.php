<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    /**
     * Display a listing of the user's donations.
     */
    public function index()
    {
        $donations = Auth::user()->donations()->with('campaign')->latest()->paginate(10);
        
        return view('donations.index', compact('donations'));
    }

    /**
     * Show the form for creating a new donation.
     */
    public function create(Campaign $campaign)
    {
        return view('donations.create', compact('campaign'));
    }

    /**
     * Store a newly created donation in storage.
     */
    public function store(Request $request, Campaign $campaign)
    {
        // Validate the request
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string|in:credit_card,bank_transfer,paypal',
            'message' => 'nullable|string',
        ]);

        // Add user_id and campaign_id
        $validated['user_id'] = Auth::id();
        $validated['campaign_id'] = $campaign->id;
        
        // Add transaction_id (in a real-world application, this would come from the payment gateway)
        $validated['transaction_id'] = 'TRX-' . time() . '-' . Auth::id();
        
        // Create the donation
        $donation = Donation::create($validated);
        
        // Update campaign's current amount
        $campaign->increment('current_amount', $validated['amount']);

        return redirect()->route('campaigns.show', $campaign)
            ->with('success', 'تم إرسال تبرعك بنجاح! شكراً لدعمك.');
    }

    /**
     * Display the specified donation.
     */
    public function show(Donation $donation)
    {
        // Check if the user is the owner of the donation or the campaign creator
        if (Auth::id() !== $donation->user_id && Auth::id() !== $donation->campaign->creator_id) {
            return redirect()->route('donations.index')
                ->with('error', 'غير مصرح لك بعرض هذا التبرع');
        }

        return view('donations.show', compact('donation'));
    }

    /**
     * Display a receipt for the specified donation.
     */
    public function receipt(Donation $donation)
    {
        // Check if the user is the owner of the donation
        if (Auth::id() !== $donation->user_id) {
            return redirect()->route('donations.index')
                ->with('error', 'غير مصرح لك بعرض إيصال هذا التبرع');
        }

        return view('donations.receipt', compact('donation'));
    }
}
