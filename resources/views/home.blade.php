<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'منصة التطوع') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=tajawal:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* ... الأنماط الموجودة ... */
            </style>
        @endif
    </head>
    <body class="font-tajawal antialiased bg-gray-50 dark:bg-gray-900">
        <div class="min-h-screen">
            <!-- الشريط العلوي -->
            <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">
                                    منصة التطوع
                                </a>
                            </div>
                        </div>
                        <div class="flex items-center">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium">لوحة التحكم</a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium">تسجيل الدخول</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="mr-4 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">إنشاء حساب</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>

            <!-- القسم الرئيسي -->
            <div class="relative">
                <!-- قسم الترحيب -->
                <div class="py-16 md:py-24 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
                    <div class="max-w-7xl mx-auto">
                        <div class="flex flex-col md:flex-row items-center">
                            <div class="md:w-1/2 mb-10 md:mb-0">
                                <h1 class="text-4xl md:text-5xl font-bold mb-6">منصة التطوع الأولى في المملكة</h1>
                                <p class="text-xl mb-8 text-indigo-100">انضم إلينا اليوم وكن جزءاً من التغيير الإيجابي في المجتمع</p>
                                <div class="flex flex-wrap gap-4">
                                    <a href="{{ route('register') }}" class="bg-white text-indigo-600 hover:bg-indigo-50 px-6 py-3 rounded-lg font-medium text-lg transition duration-150 ease-in-out shadow-md">ابدأ التطوع الآن</a>
                                    <a href="#campaigns" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-indigo-600 px-6 py-3 rounded-lg font-medium text-lg transition duration-150 ease-in-out">استكشف الحملات</a>
                                </div>
                            </div>
                            <div class="md:w-1/2 flex justify-center">
                                <img src="{{ asset('images/volunteer-hero.svg') }}" alt="التطوع" class="w-full max-w-md">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- قسم الإحصائيات -->
                <div class="py-12 bg-white dark:bg-gray-800">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="bg-indigo-50 dark:bg-indigo-900 p-6 rounded-xl text-center transform transition duration-300 hover:scale-105">
                                <div class="text-4xl font-bold text-indigo-600 dark:text-indigo-400 mb-2">{{ \App\Models\Campaign::count() }}+</div>
                                <div class="text-gray-700 dark:text-gray-300 font-medium">حملة تطوعية</div>
                            </div>
                            <div class="bg-indigo-50 dark:bg-indigo-900 p-6 rounded-xl text-center transform transition duration-300 hover:scale-105">
                                <div class="text-4xl font-bold text-indigo-600 dark:text-indigo-400 mb-2">{{ \App\Models\User::count() }}+</div>
                                <div class="text-gray-700 dark:text-gray-300 font-medium">متطوع مسجل</div>
                            </div>
                            <div class="bg-indigo-50 dark:bg-indigo-900 p-6 rounded-xl text-center transform transition duration-300 hover:scale-105">
                                <div class="text-4xl font-bold text-indigo-600 dark:text-indigo-400 mb-2">{{ \App\Models\ParticipationRequest::where('status', 'approved')->count() }}+</div>
                                <div class="text-gray-700 dark:text-gray-300 font-medium">مشاركة تطوعية</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- قسم الحملات -->
                <div id="campaigns" class="py-16 bg-gray-50 dark:bg-gray-900">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="text-center mb-12">
                            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">أحدث الحملات التطوعية</h2>
                            <p class="text-xl text-gray-600 dark:text-gray-400">انضم إلى إحدى هذه الحملات وكن جزءاً من التغيير</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach(\App\Models\Campaign::latest()->take(6)->get() as $campaign)
                                <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition duration-300">
                                    @if($campaign->image)
                                        <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}" class="w-full h-48 object-cover">
                                    @else
                                        <div class="w-full h-48 bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center">
                                            <svg class="w-16 h-16 text-indigo-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="p-6">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="px-3 py-1 bg-{{ $campaign->type === 'volunteer' ? 'blue' : 'green' }}-100 text-{{ $campaign->type === 'volunteer' ? 'blue' : 'green' }}-800 dark:bg-{{ $campaign->type === 'volunteer' ? 'blue' : 'green' }}-900 dark:text-{{ $campaign->type === 'volunteer' ? 'blue' : 'green' }}-200 rounded-full text-xs font-medium">
                                                {{ $campaign->type === 'volunteer' ? 'تطوع' : 'مساعدة' }}
                                            </span>
                                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $campaign->created_at->diffForHumans() }}</span>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $campaign->title }}</h3>
                                        <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">{{ $campaign->description }}</p>
                                        <a href="{{ route('campaigns.show', $campaign) }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">عرض التفاصيل</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="text-center mt-10">
                            <a href="{{ route('campaigns.index') }}" class="inline-block bg-indigo-100 hover:bg-indigo-200 text-indigo-700 dark:bg-indigo-900 dark:hover:bg-indigo-800 dark:text-indigo-300 px-6 py-3 rounded-lg font-medium transition duration-150 ease-in-out">عرض جميع الحملات</a>
                        </div>
                    </div>
                </div>

                <!-- قسم كيف يعمل -->
                <div class="py-16 bg-white dark:bg-gray-800">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="text-center mb-12">
                            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">كيف تعمل منصتنا؟</h2>
                            <p class="text-xl text-gray-600 dark:text-gray-400">خطوات بسيطة للمشاركة في العمل التطوعي</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="text-center p-6">
                                <div class="w-16 h-16 bg-indigo-100 dark:bg-indigo-900 rounded-full flex items-center justify-center text-indigo-600 dark:text-indigo-400 text-2xl font-bold mx-auto mb-4">1</div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">سجل في المنصة</h3>
                                <p class="text-gray-600 dark:text-gray-400">أنشئ حسابك الشخصي أو المؤسسي للوصول إلى كافة الخدمات</p>
                            </div>
                            <div class="text-center p-6">
                                <div class="w-16 h-16 bg-indigo-100 dark:bg-indigo-900 rounded-full flex items-center justify-center text-indigo-600 dark:text-indigo-400 text-2xl font-bold mx-auto mb-4">2</div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">ابحث عن الحملات</h3>
                                <p class="text-gray-600 dark:text-gray-400">استعرض الحملات المتاحة واختر ما يناسب اهتماماتك ومهاراتك</p>
                            </div>
                            <div class="text-center p-6">
                                <div class="w-16 h-16 bg-indigo-100 dark:bg-indigo-900 rounded-full flex items-center justify-center text-indigo-600 dark:text-indigo-400 text-2xl font-bold mx-auto mb-4">3</div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">شارك وأحدث فرقاً</h3>
                                <p class="text-gray-600 dark:text-gray-400">قدم طلب المشاركة وكن جزءاً من التغيير الإيجابي في المجتمع</p>
                            </div>
                        </div>
                    </div>
                </div>

                               <!-- قسم التذييل -->
                               <footer class="bg-gray-900 text-white py-12">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex flex-col md:flex-row justify-between">
                            <div class="mb-8 md:mb-0">
                                <h3 class="text-2xl font-bold text-indigo-400 mb-4">منصة التطوع</h3>
                                <p class="text-gray-400 max-w-md">منصة تربط المتطوعين بالفرص التطوعية وتسهل عملية المشاركة في الأعمال التطوعية والخيرية في جميع أنحاء المملكة.</p>
                            </div>
                            <div class="grid grid-cols-2 gap-8 sm:grid-cols-3 sm:gap-6">
                                <div>
                                    <h3 class="text-sm font-semibold text-white tracking-wider uppercase mb-4">روابط سريعة</h3>
                                    <ul class="space-y-2">
                                        <li><a href="{{ route('campaigns.index') }}" class="text-gray-400 hover:text-indigo-400">الحملات</a></li>
                                        <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-indigo-400">تسجيل الدخول</a></li>
                                        <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-indigo-400">إنشاء حساب</a></li>
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="text-sm font-semibold text-white tracking-wider uppercase mb-4">تواصل معنا</h3>
                                    <ul class="space-y-2">
                                        <li><a href="#" class="text-gray-400 hover:text-indigo-400">عن المنصة</a></li>
                                        <li><a href="#" class="text-gray-400 hover:text-indigo-400">اتصل بنا</a></li>
                                        <li><a href="#" class="text-gray-400 hover:text-indigo-400">الأسئلة الشائعة</a></li>
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="text-sm font-semibold text-white tracking-wider uppercase mb-4">قانوني</h3>
                                    <ul class="space-y-2">
                                        <li><a href="#" class="text-gray-400 hover:text-indigo-400">سياسة الخصوصية</a></li>
                                        <li><a href="#" class="text-gray-400 hover:text-indigo-400">شروط الاستخدام</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="border-t border-gray-800 pt-8 mt-8 text-center">
                            <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} منصة التطوع. جميع الحقوق محفوظة.</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>