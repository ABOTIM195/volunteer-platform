<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * تبديل لغة التطبيق
     *
     * @param string $locale رمز اللغة
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switch($locale)
    {
        // التحقق من أن اللغة المطلوبة مدعومة
        if (!in_array($locale, ['ar', 'en'])) {
            $locale = 'ar'; // اللغة الافتراضية العربية
        }

        // حفظ اللغة في الجلسة
        Session::put('locale', $locale);
        
        // تعيين لغة التطبيق الحالية
        App::setLocale($locale);

        // العودة إلى الصفحة السابقة
        return redirect()->back();
    }
}
