<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BadgeController extends Controller
{
    public function index()
    {
        $badges = Badge::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.badges.index', compact('badges'));
    }

    public function create()
    {
        return view('admin.badges.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'points_required' => ['required', 'integer', 'min:0'],
            'image' => ['required', 'image', 'max:2048'],
            'is_featured' => ['boolean'],
        ]);

        $badge = new Badge($validated);
        $badge->slug = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('badges', 'public');
            $badge->image = $path;
        }

        $badge->save();

        return redirect()->route('admin.badges.index')
            ->with('success', 'تم إنشاء الشارة بنجاح.');
    }

    public function edit(Badge $badge)
    {
        return view('admin.badges.edit', compact('badge'));
    }

    public function update(Request $request, Badge $badge)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'points_required' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_featured' => ['boolean'],
        ]);

        $badge->fill($validated);
        $badge->is_featured = $request->has('is_featured');

        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا وجدت
            if ($badge->image) {
                Storage::disk('public')->delete($badge->image);
            }
            
            $path = $request->file('image')->store('badges', 'public');
            $badge->image = $path;
        }

        $badge->save();

        return redirect()->route('admin.badges.index')
            ->with('success', 'تم تحديث الشارة بنجاح.');
    }

    public function destroy(Badge $badge)
    {
        // حذف الصورة إذا وجدت
        if ($badge->image) {
            Storage::disk('public')->delete($badge->image);
        }

        $badge->delete();

        return redirect()->route('admin.badges.index')
            ->with('success', 'تم حذف الشارة بنجاح.');
    }
}