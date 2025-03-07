<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
    
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
    
        // معالجة تحميل الصورة الشخصية
        if ($request->hasFile('avatar')) {
            // حذف الصورة القديمة إذا وجدت
            if ($request->user()->avatar) {
                Storage::disk('public')->delete($request->user()->avatar);
            }
            
            // تخزين الصورة الجديدة
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $request->user()->avatar = $avatarPath;
        } elseif ($request->has('remove_avatar') && $request->remove_avatar) {
            // إزالة الصورة الحالية إذا طلب المستخدم ذلك
            if ($request->user()->avatar) {
                Storage::disk('public')->delete($request->user()->avatar);
            }
            $request->user()->avatar = null;
        }
    
        $request->user()->save();
    
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
