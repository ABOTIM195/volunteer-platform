<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Show the form for changing user type.
     */
    public function showChangeTypeForm()
    {
        return view('change-user-type');
    }

    /**
     * Change the user type.
     */
    public function changeType(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'user_type' => 'required|in:regular,team,organization',
        ]);

        // Get the current user
        $user = Auth::user();
        
        // Update user type
        $user->update([
            'type' => $validated['user_type']
        ]);

        return redirect()->route('user-check')
            ->with('success', 'تم تغيير نوع الحساب بنجاح');
    }
}
