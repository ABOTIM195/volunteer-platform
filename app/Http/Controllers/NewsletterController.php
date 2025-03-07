<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NewsletterController extends Controller
{
    /**
     * معالجة طلب الاشتراك في النشرة البريدية
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subscribe(Request $request)
    {
        // التحقق من البيانات
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        try {
            // حفظ البريد الإلكتروني في قاعدة البيانات
            $newsletter = Newsletter::updateOrCreate(
                ['email' => $validated['email']],
                ['is_active' => true]
            );
            
            // تسجيل نجاح العملية
            Log::info('تم الاشتراك في النشرة البريدية بنجاح', ['email' => $validated['email']]);
            
            // العودة مع رسالة نجاح
            return back()->with('success', 'تم الاشتراك في النشرة البريدية بنجاح. سنرسل لك آخر الفرص التطوعية في سوريا.');
        } catch (\Exception $e) {
            // تسجيل الخطأ
            Log::error('فشل الاشتراك في النشرة البريدية', [
                'email' => $validated['email'],
                'error' => $e->getMessage()
            ]);
            
            // العودة مع رسالة خطأ
            return back()->with('error', 'حدث خطأ أثناء الاشتراك في النشرة البريدية. الرجاء المحاولة مرة أخرى لاحقاً.');
        }
    }
}