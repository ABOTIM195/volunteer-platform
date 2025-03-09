<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * عرض صفحة الاتصال
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * معالجة طلب نموذج الاتصال
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // التحقق من البيانات
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255', // إضافة التحقق من حقل الموضوع
            'message' => 'required|string',
        ]);

        try {
            // حفظ الرسالة في قاعدة البيانات
            $contact = Contact::create($validated);
            
            // تسجيل نجاح العملية
            Log::info('تم استلام رسالة اتصال جديدة', ['email' => $validated['email']]);
            
            // العودة مع رسالة نجاح
            return back()->with('success', 'تم إرسال رسالتك بنجاح. سنتواصل معك قريباً.');
        } catch (\Exception $e) {
            // تسجيل الخطأ
            Log::error('فشل في حفظ رسالة الاتصال', [
                'email' => $validated['email'],
                'error' => $e->getMessage()
            ]);
            
            // العودة مع رسالة خطأ
            return back()->with('error', 'حدث خطأ أثناء إرسال الرسالة. الرجاء المحاولة مرة أخرى لاحقاً.');
        }
    }
}