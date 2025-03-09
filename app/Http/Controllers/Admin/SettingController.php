<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        $settings = $this->getSettings();
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $section = $request->input('section', 'general');
        
        switch ($section) {
            case 'general':
                $validated = $request->validate([
                    'site_name' => ['required', 'string', 'max:255'],
                    'site_description' => ['required', 'string'],
                    'contact_email' => ['required', 'email'],
                    'footer_text' => ['nullable', 'string'],
                    'enable_registration' => ['boolean'],
                ]);
                break;
                
            case 'users':
                $validated = $request->validate([
                    'default_user_role' => ['required', 'string', 'in:user,volunteer'],
                    'points_per_participation' => ['required', 'integer', 'min:0'],
                ]);
                break;
                
            case 'campaigns':
                $validated = $request->validate([
                    'auto_approve_campaigns' => ['boolean'],
                    'max_featured_campaigns' => ['required', 'integer', 'min:0'],
                    'campaigns_per_page' => ['required', 'integer', 'min:1'],
                ]);
                break;
                
            case 'donations':
                $validated = $request->validate([
                    'currency' => ['required', 'string', 'max:3'],
                    'min_donation_amount' => ['required', 'numeric', 'min:0'],
                    'payment_gateway' => ['required', 'string'],
                ]);
                break;
                
            default:
                return back()->with('error', 'قسم الإعدادات غير صالح.');
        }
        
        // تحديث الإعدادات
        $settings = $this->getSettings();
        $settings = array_merge($settings, $validated);
        
        // حفظ الإعدادات في ملف
        $this->saveSettings($settings);
        
        // مسح ذاكرة التخزين المؤقت
        Cache::forget('settings');
        
        return back()->with('success', 'تم تحديث الإعدادات بنجاح.');
    }
    
    private function getSettings()
    {
        return Cache::remember('settings', 60 * 24, function () {
            $path = storage_path('app/settings.json');
            
            if (file_exists($path)) {
                return json_decode(file_get_contents($path), true);
            }
            
            return $this->getDefaultSettings();
        });
    }
    
    private function saveSettings(array $settings)
    {
        $path = storage_path('app/settings.json');
        file_put_contents($path, json_encode($settings, JSON_PRETTY_PRINT));
    }
    
    private function getDefaultSettings()
    {
        return [
            'site_name' => 'منصة التطوع',
            'site_description' => 'منصة للتطوع والمساهمة في المجتمع',
            'contact_email' => 'contact@volunteer-platform.com',
            'footer_text' => 'جميع الحقوق محفوظة © ' . date('Y'),
            'enable_registration' => true,
            'default_user_role' => 'user',
            'points_per_participation' => 10,
            'auto_approve_campaigns' => false,
            'max_featured_campaigns' => 5,
            'campaigns_per_page' => 12,
            'currency' => 'SAR',
            'min_donation_amount' => 10,
            'payment_gateway' => 'stripe',
        ];
    }
}