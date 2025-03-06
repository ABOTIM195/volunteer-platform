<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Store a newly created like in storage.
     */
    public function store(Campaign $campaign)
    {
        // Check if the user already liked this campaign
        $existingLike = $campaign->likes()->where('user_id', Auth::id())->first();
        
        if (!$existingLike) {
            // Create a new like
            Like::create([
                'user_id' => Auth::id(),
                'campaign_id' => $campaign->id,
            ]);
            
            $message = 'تم الإعجاب بالحملة بنجاح';
        } else {
            $message = 'لقد أعجبت بهذه الحملة بالفعل';
        }

        return redirect()->route('campaigns.show', $campaign)
            ->with('success', $message);
    }

    /**
     * Remove the specified like from storage.
     */
    public function destroy(Campaign $campaign)
    {
        // Delete the like
        $campaign->likes()->where('user_id', Auth::id())->delete();

        return redirect()->route('campaigns.show', $campaign)
            ->with('success', 'تم إلغاء الإعجاب بنجاح');
    }
}
