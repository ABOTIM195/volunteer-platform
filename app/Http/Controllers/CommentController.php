<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, Campaign $campaign)
    {
        // Validate the request
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // Add user_id and campaign_id
        $validated['user_id'] = Auth::id();
        $validated['campaign_id'] = $campaign->id;
        
        // Create the comment
        $comment = Comment::create($validated);

        return redirect()->route('campaigns.show', $campaign)
            ->with('success', 'تم إضافة تعليقك بنجاح');
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy(Comment $comment)
    {
        // Check if the user is the owner of the comment or the campaign creator
        if (Auth::id() !== $comment->user_id && Auth::id() !== $comment->campaign->creator_id) {
            return redirect()->route('campaigns.show', $comment->campaign)
                ->with('error', 'غير مصرح لك بحذف هذا التعليق');
        }

        // Delete the comment
        $comment->delete();

        return redirect()->route('campaigns.show', $comment->campaign)
            ->with('success', 'تم حذف التعليق بنجاح');
    }
}
