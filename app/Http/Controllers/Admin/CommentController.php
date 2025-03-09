<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Campaign; // إضافة استيراد فئة Campaign
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $query = Comment::with(['user', 'campaign']);
    
        // تطبيق البحث إذا تم تقديمه
        if ($request->has('search')) {
            $query->where('content', 'like', '%' . $request->search . '%');
        }
    
        // تصفية حسب الحملة إذا تم تحديدها
        if ($request->has('campaign_id') && $request->campaign_id) {
            $query->where('campaign_id', $request->campaign_id);
        }
    
        // الحصول على التعليقات مع ترقيم الصفحات
        $comments = $query->latest()->paginate(15);
    
        // الحصول على جميع الحملات للاستخدام في قائمة التصفية
        $campaigns = Campaign::select('id', 'title')->get();
    
        return view('admin.comments.index', compact('comments', 'campaigns'));
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('admin.comments.index')
            ->with('success', 'تم حذف التعليق بنجاح.');
    }
}