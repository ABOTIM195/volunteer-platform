<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * عرض صفحة من نحن
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * عرض صفحة اتصل بنا
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * عرض صفحة الأسئلة الشائعة
     */
    public function faq()
    {
        return view('pages.faq');
    }

    /**
     * عرض صفحة سياسة الخصوصية
     */
    public function privacy()
    {
        return view('pages.privacy');
    }

    /**
     * عرض صفحة شروط الاستخدام
     */
    public function terms()
    {
        return view('pages.terms');
    }
}