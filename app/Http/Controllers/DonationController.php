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
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'notes' => 'nullable|string|max:255',
        ]);
    
        // Create the donation
        $donation = new Donation();
        $donation->user_id = auth()->id();
        $donation->campaign_id = $campaign->id;
        $donation->amount = $validated['amount'];
        $donation->notes = $validated['notes'] ?? null;
        $donation->save();
    
        // Update the campaign's current amount
        $campaign->current_amount += $validated['amount'];
        $campaign->save();
    
        return redirect()->route('campaigns.show', $campaign)
            ->with('success', 'تم التبرع بنجاح! شكراً لمساهمتك.');
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
