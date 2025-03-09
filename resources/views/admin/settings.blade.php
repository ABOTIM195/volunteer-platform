@extends('admin.layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">إعدادات المنصة</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">تعديل إعدادات منصة التطوع</p>
    </div>

    @if(session('success'))
        <div class="p-4 mb-6 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-900 dark:text-green-300" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- الإعدادات العامة -->
        <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">الإعدادات العامة</h2>
            
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="section" value="general">
                
                <div class="mb-4">
                    <label for="site_name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">اسم المنصة</label>
                    <input type="text" name="site_name" id="site_name" value="{{ $settings['site_name'] ?? config('app.name') }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                
                <div class="mb-4">
                    <label for="site_description" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">وصف المنصة</label>
                    <textarea name="site_description" id="site_description" rows="3" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $settings['site_description'] ?? '' }}</textarea>
                </div>
                
                <div class="mb-4">
                    <label for="contact_email" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">البريد الإلكتروني للتواصل</label>
                    <input type="email" name="contact_email" id="contact_email" value="{{ $settings['contact_email'] ?? '' }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                
                <div class="mb-4">
                    <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">رقم الهاتف للتواصل</label>
                    <input type="text" name="phone_number" id="phone_number" value="{{ $settings['phone_number'] ?? '' }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                
                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600">
                        حفظ الإعدادات
                    </button>
                </div>
            </form>
        </div>
        
        <!-- إعدادات التسجيل والمستخدمين -->
        <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">إعدادات التسجيل والمستخدمين</h2>
            
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="section" value="users">
                
                <div class="mb-4">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="allow_registration" value="1" class="sr-only peer" {{ ($settings['allow_registration'] ?? '1') == '1' ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        <span class="mr-3 rtl:mr-0 rtl:ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">السماح بالتسجيل الجديد</span>
                    </label>
                </div>
                
                <div class="mb-4">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="email_verification" value="1" class="sr-only peer" {{ ($settings['email_verification'] ?? '1') == '1' ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        <span class="mr-3 rtl:mr-0 rtl:ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">تفعيل التحقق من البريد الإلكتروني</span>
                    </label>
                </div>
                
                <div class="mb-4">
                    <label for="default_user_role" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">الدور الافتراضي للمستخدمين الجدد</label>
                    <select name="default_user_role" id="default_user_role" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="user" {{ ($settings['default_user_role'] ?? 'user') == 'user' ? 'selected' : '' }}>مستخدم عادي</option>
                        <option value="volunteer" {{ ($settings['default_user_role'] ?? '') == 'volunteer' ? 'selected' : '' }}>متطوع</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label for="points_per_participation" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">النقاط لكل مشاركة</label>
                    <input type="number" name="points_per_participation" id="points_per_participation" value="{{ $settings['points_per_participation'] ?? '10' }}" min="0" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                
                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600">
                        حفظ الإعدادات
                    </button>
                </div>
            </form>
        </div>
        
        <!-- إعدادات الحملات -->
        <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">إعدادات الحملات</h2>
            
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="section" value="campaigns">
                
                <div class="mb-4">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="auto_approve_campaigns" value="1" class="sr-only peer" {{ ($settings['auto_approve_campaigns'] ?? '0') == '1' ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        <span class="mr-3 rtl:mr-0 rtl:ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">الموافقة التلقائية على الحملات الجديدة</span>
                    </label>
                </div>
                
                <div class="mb-4">
                    <label for="max_featured_campaigns" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">الحد الأقصى للحملات المميزة</label>
                    <input type="number" name="max_featured_campaigns" id="max_featured_campaigns" value="{{ $settings['max_featured_campaigns'] ?? '5' }}" min="0" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                
                <div class="mb-4">
                    <label for="campaigns_per_page" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">عدد الحملات في الصفحة</label>
                    <input type="number" name="campaigns_per_page" id="campaigns_per_page" value="{{ $settings['campaigns_per_page'] ?? '12' }}" min="1" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                
                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600">
                        حفظ الإعدادات
                    </button>
                </div>
            </form>
        </div>
        
        <!-- إعدادات التبرعات -->
        <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">إعدادات التبرعات</h2>
            
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="section" value="donations">
                
                <div class="mb-4">
                    <label for="currency" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">العملة الافتراضية</label>
                    <select name="currency" id="currency" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="SAR" {{ ($settings['currency'] ?? 'SAR') == 'SAR' ? 'selected' : '' }}>ريال سعودي (SAR)</option>
                        <option value="USD" {{ ($settings['currency'] ?? '') == 'USD' ? 'selected' : '' }}>دولار أمريكي (USD)</option>
                        <option value="EUR" {{ ($settings['currency'] ?? '') == 'EUR' ? 'selected' : '' }}>يورو (EUR)</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label for="min_donation_amount" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">الحد الأدنى للتبرع</label>
                    <input type="number" name="min_donation_amount" id="min_donation_amount" value="{{ $settings['min_donation_amount'] ?? '10' }}" min="0" step="0.01" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                
                <div class="mb-4">
                    <label for="payment_gateway" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">بوابة الدفع</label>
                    <select name="payment_gateway" id="payment_gateway" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="stripe" {{ ($settings['payment_gateway'] ?? '') == 'stripe' ? 'selected' : '' }}>Stripe</option>
                        <option value="paypal" {{ ($settings['payment_gateway'] ?? '') == 'paypal' ? 'selected' : '' }}>PayPal</option>
                        <option value="mada" {{ ($settings['payment_gateway'] ?? 'mada') == 'mada' ? 'selected' : '' }}>مدى</option>
                    </select>
                </div>
                
                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600">
                        حفظ الإعدادات
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection