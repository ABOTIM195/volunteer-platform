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
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AOS Animation Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

    <!-- Swiper JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
</head>

<body class="font-tajawal antialiased">
    <!-- تأثير الخلفية المتحركة -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-teal-100/30 via-transparent to-transparent dark:from-teal-900/20"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_left,_var(--tw-gradient-stops))] from-emerald-100/30 via-transparent to-transparent dark:from-emerald-900/20"></div>
    </div>

    <div class="min-h-screen relative z-10">
        <!-- الشريط العلوي -->
        <nav class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-md border-b border-gray-100 dark:border-gray-700 shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('dashboard') }}" class="text-2xl font-bold bg-gradient-to-r from-teal-500 to-emerald-600 bg-clip-text text-transparent hover:from-emerald-600 hover:to-teal-500 transition duration-300">
                                منصة التطوع
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center">
                        @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-700 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400 px-3 py-2 rounded-md text-sm font-medium transition duration-300">لوحة التحكم</a>
                        @else
                        <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400 px-3 py-2 rounded-md text-sm font-medium transition duration-300">تسجيل الدخول</a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="mr-4 bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-emerald-600 hover:to-teal-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">إنشاء حساب</a>
                        @endif
                        @endauth

                        <!-- زر تبديل الوضع المظلم -->
                        <button id="theme-toggle" type="button" class="mr-4 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2">
                            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- القسم الرئيسي -->
        <div class="relative">
            <!-- قسم الترحيب -->
            <div class="py-20 md:py-28 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-teal-600 via-teal-500 to-emerald-600 relative overflow-hidden">
                <!-- أشكال زخرفية -->
                <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-10">
                    <div class="absolute -top-[10%] -left-[5%] w-[40%] h-[40%] rounded-full bg-white"></div>
                    <div class="absolute top-[60%] left-[60%] w-[30%] h-[30%] rounded-full bg-white"></div>
                    <div class="absolute top-[20%] left-[80%] w-[15%] h-[15%] rounded-full bg-white"></div>
                </div>

                <div class="max-w-7xl mx-auto relative z-10">
                    <div class="flex flex-col md:flex-row items-center">
                        <div class="md:w-1/2 mb-10 md:mb-0" data-aos="fade-right" data-aos-duration="1000">
                            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight text-white">منصة التطوع <span class="text-teal-100">الأولى</span> في المملكة</h1>
                            <p class="text-xl mb-8 text-teal-100">انضم إلينا اليوم وكن جزءاً من التغيير الإيجابي في المجتمع</p>
                            <div class="flex flex-wrap gap-4">
                                <a href="{{ route('register') }}" class="bg-white text-teal-600 hover:bg-teal-50 px-6 py-3 rounded-lg font-medium text-lg transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                    <span class="flex items-center">
                                        <span>ابدأ التطوع الآن</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 rtl:rotate-180" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </a>
                                <a href="#campaigns" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-teal-600 px-6 py-3 rounded-lg font-medium text-lg transition duration-300 transform hover:-translate-y-1">استكشف الحملات</a>
                            </div>
                        </div>
                        <div class="md:w-1/2 flex justify-center" data-aos="fade-left" data-aos-duration="1000">
                            <div class="relative">
                                <div class="absolute inset-0 bg-gradient-to-br from-teal-300/20 to-emerald-300/20 rounded-full blur-3xl"></div>
                                <div class="md:w-1/2 flex justify-center" data-aos="fade-left" data-aos-duration="1000">
                                    <div class="relative">
                                        <div class="absolute inset-0 bg-gradient-to-br from-teal-300/20 to-emerald-300/20 rounded-full blur-3xl"></div>
                                        <img src="{{ asset('images/gallery/volunteer1.jpg') }}" alt="التطوع" class="w-full max-w-md rounded-lg shadow-xl relative z-10 object-cover">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- قسم الإحصائيات -->
            <div class="py-16 bg-white dark:bg-gray-800 relative">
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-teal-50/50 via-transparent to-transparent dark:from-teal-900/10"></div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="bg-gradient-to-br from-white to-teal-50 dark:from-gray-800 dark:to-teal-900/30 p-8 rounded-2xl text-center transform transition duration-500 hover:scale-105 shadow-xl hover:shadow-2xl border border-teal-100/50 dark:border-teal-900/50" data-aos="zoom-in" data-aos-delay="100">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-teal-100 dark:bg-teal-900/50 mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal-600 dark:text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-teal-500 to-emerald-600 mb-2">{{ \App\Models\Campaign::count() }}+</div>
                            <div class="text-gray-700 dark:text-gray-300 font-medium text-lg">حملة تطوعية</div>
                        </div>
                        <div class="bg-gradient-to-br from-white to-teal-50 dark:from-gray-800 dark:to-teal-900/30 p-8 rounded-2xl text-center transform transition duration-500 hover:scale-105 shadow-xl hover:shadow-2xl border border-teal-100/50 dark:border-teal-900/50" data-aos="zoom-in" data-aos-delay="200">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-emerald-100 dark:bg-emerald-900/50 mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-600 dark:text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-teal-500 to-emerald-600 mb-2">{{ \App\Models\User::count() }}+</div>
                            <div class="text-gray-700 dark:text-gray-300 font-medium text-lg">متطوع مسجل</div>
                        </div>
                        <div class="bg-gradient-to-br from-white to-teal-50 dark:from-gray-800 dark:to-teal-900/30 p-8 rounded-2xl text-center transform transition duration-500 hover:scale-105 shadow-xl hover:shadow-2xl border border-teal-100/50 dark:border-teal-900/50" data-aos="zoom-in" data-aos-delay="300">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-teal-100 dark:bg-teal-900/50 mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal-600 dark:text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-teal-500 to-emerald-600 mb-2">{{ \App\Models\ParticipationRequest::where('status', 'approved')->count() }}+</div>
                            <div class="text-gray-700 dark:text-gray-300 font-medium text-lg">مشاركة تطوعية</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- قسم الحملات التطوعية -->
            <div id="campaigns" class="py-16 bg-gray-50 dark:bg-gray-900">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12" data-aos="fade-up">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">أحدث الحملات التطوعية</h2>
                        <p class="text-xl text-gray-600 dark:text-gray-400">انضم إلى إحدى هذه الحملات وكن جزءاً من التغيير</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach(\App\Models\Campaign::latest()->take(6)->get() as $campaign)
                        <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="relative h-48 bg-gradient-to-r from-teal-500 to-emerald-500">
                                @if($campaign->image)
                                <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover">
                                @else
                                <div class="flex items-center justify-center h-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                                @endif
                                <div class="absolute top-4 right-4 bg-teal-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $campaign->category->name ?? 'عام' }}
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $campaign->title }}</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">{{ $campaign->description }}</p>
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center text-gray-500 dark:text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span>{{ $campaign->location }}</span>
                                    </div>
                                    <div class="flex items-center text-gray-500 dark:text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>{{ \Carbon\Carbon::parse($campaign->start_date)->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        <span class="font-medium text-teal-600 dark:text-teal-400">{{ $campaign->volunteers_count }}</span> / {{ $campaign->required_volunteers }} متطوع
                                    </div>
                                    <a href="{{ route('campaigns.show', $campaign) }}" class="inline-flex items-center px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium rounded-lg transition duration-300">
                                        التفاصيل
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="text-center mt-10" data-aos="fade-up">
                        <a href="{{ route('campaigns.index') }}" class="inline-block bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-600 hover:to-emerald-700 text-white px-6 py-3 rounded-lg font-medium transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1">عرض جميع الحملات</a>
                    </div>
                </div>
            </div>

            <!-- قسم المميزات -->
            <div class="py-16 bg-white dark:bg-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12" data-aos="fade-up">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">لماذا تختار منصتنا؟</h2>
                        <p class="text-xl text-gray-600 dark:text-gray-400">نقدم لك تجربة تطوع فريدة ومميزة</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="bg-gray-50 dark:bg-gray-700 p-8 rounded-xl text-center" data-aos="fade-up" data-aos-delay="100">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-teal-100 dark:bg-teal-900 mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal-600 dark:text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">موثوقية وأمان</h3>
                            <p class="text-gray-600 dark:text-gray-400">نتحقق من جميع الحملات التطوعية للتأكد من مصداقيتها وأمانها للمتطوعين</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-8 rounded-xl text-center" data-aos="fade-up" data-aos-delay="200">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-emerald-100 dark:bg-emerald-900 mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-600 dark:text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">شهادات معتمدة</h3>
                            <p class="text-gray-600 dark:text-gray-400">احصل على شهادات تطوع معتمدة يمكنك استخدامها في سيرتك الذاتية ومسيرتك المهنية</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-8 rounded-xl text-center" data-aos="fade-up" data-aos-delay="300">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-teal-100 dark:bg-teal-900 mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal-600 dark:text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">موثوقية وأمان</h3>
                            <p class="text-gray-600 dark:text-gray-400">نتحقق من جميع الحملات التطوعية للتأكد من مصداقيتها وأمانها للمتطوعين</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-8 rounded-xl text-center" data-aos="fade-up" data-aos-delay="200">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-emerald-100 dark:bg-emerald-900 mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-600 dark:text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">شهادات معتمدة</h3>
                            <p class="text-gray-600 dark:text-gray-400">احصل على شهادات تطوع معتمدة يمكنك استخدامها في سيرتك الذاتية ومسيرتك المهنية</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-8 rounded-xl text-center" data-aos="fade-up" data-aos-delay="300">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-teal-100 dark:bg-teal-900 mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal-600 dark:text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">تجربة سلسة</h3>
                            <p class="text-gray-600 dark:text-gray-400">واجهة سهلة الاستخدام تمكنك من التسجيل في الحملات التطوعية بنقرات بسيطة</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- قسم الشهادات -->
            <div class="py-16 bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12" data-aos="fade-up">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">ماذا يقول المتطوعون عنا</h2>
                        <p class="text-xl text-gray-600 dark:text-gray-400">آراء المتطوعين الذين شاركوا في حملاتنا</p>
                    </div>

                    <div class="swiper testimonialSwiper" data-aos="fade-up">
                        <div class="swiper-wrapper pb-8">
                            <div class="swiper-slide">
                                <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg">
                                    <div class="flex items-center mb-4">
                                        <div class="h-12 w-12 rounded-full bg-teal-100 dark:bg-teal-900 flex items-center justify-center text-xl font-bold text-teal-600 dark:text-teal-300 mr-4">أ</div>
                                        <div>
                                            <h4 class="text-lg font-medium text-gray-900 dark:text-white">أحمد محمد</h4>
                                            <p class="text-gray-500 dark:text-gray-400">متطوع في حملة تنظيف الشواطئ</p>
                                        </div>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-400">"تجربة رائعة ومنظمة بشكل احترافي. سعدت بالمشاركة في هذه الحملة وسأشارك في المزيد من الحملات المستقبلية."</p>
                                    <div class="mt-4 flex text-teal-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg">
                                    <div class="flex items-center mb-4">
                                        <div class="h-12 w-12 rounded-full bg-emerald-100 dark:bg-emerald-900 flex items-center justify-center text-xl font-bold text-emerald-600 dark:text-emerald-300 mr-4">س</div>
                                        <div>
                                            <h4 class="text-lg font-medium text-gray-900 dark:text-white">سارة عبدالله</h4>
                                            <p class="text-gray-500 dark:text-gray-400">متطوعة في حملة توزيع الطعام</p>
                                        </div>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-400">"شعرت بسعادة كبيرة عندما رأيت الابتسامة على وجوه المحتاجين. المنصة سهلت علي عملية التسجيل والمشاركة في الحملة."</p>
                                    <div class="mt-4 flex text-teal-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg">
                                    <div class="flex items-center mb-4">
                                        <div class="h-12 w-12 rounded-full bg-teal-100 dark:bg-teal-900 flex items-center justify-center text-xl font-bold text-teal-600 dark:text-teal-300 mr-4">م</div>
                                        <div>
                                            <h4 class="text-lg font-medium text-gray-900 dark:text-white">محمد خالد</h4>
                                            <p class="text-gray-500 dark:text-gray-400">متطوع في حملة زراعة الأشجار</p>
                                        </div>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-400">"منصة رائعة تتيح لي فرصة المساهمة في تحسين البيئة. أنصح الجميع بالتسجيل والمشاركة في الحملات التطوعية."</p>
                                    <div class="mt-4 flex text-teal-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>

            <!-- قسم الشركاء -->
            <div class="py-16 bg-white dark:bg-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12" data-aos="fade-up">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">شركاؤنا</h2>
                        <p class="text-xl text-gray-600 dark:text-gray-400">نفخر بالتعاون مع هؤلاء الشركاء لدعم العمل التطوعي</p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 items-center">
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-xl flex items-center justify-center h-24 transition duration-300 transform hover:scale-105 hover:shadow-md" data-aos="zoom-in" data-aos-delay="100">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-teal-600 dark:text-teal-400">شركة الأمل</div>
                            </div>
                        </div>
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-xl flex items-center justify-center h-24 transition duration-300 transform hover:scale-105 hover:shadow-md" data-aos="zoom-in" data-aos-delay="200">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">مؤسسة التنمية</div>
                            </div>
                        </div>
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-xl flex items-center justify-center h-24 transition duration-300 transform hover:scale-105 hover:shadow-md" data-aos="zoom-in" data-aos-delay="300">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-teal-600 dark:text-teal-400">جمعية العطاء</div>
                            </div>
                        </div>
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-xl flex items-center justify-center h-24 transition duration-300 transform hover:scale-105 hover:shadow-md" data-aos="zoom-in" data-aos-delay="400">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">مركز المستقبل</div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-10" data-aos="fade-up">
                        <a href="#" class="inline-block bg-gradient-to-r from-teal-100 to-emerald-100 hover:from-teal-200 hover:to-emerald-200 text-teal-700 dark:bg-gradient-to-r dark:from-teal-900 dark:to-emerald-900 dark:hover:from-teal-800 dark:hover:to-emerald-800 dark:text-teal-300 px-6 py-3 rounded-lg font-medium transition duration-300 shadow-md hover:shadow-lg">كن شريكاً معنا</a>
                    </div>
                </div>
            </div>

            <!-- قسم التواصل -->
            <div class="py-16 bg-gray-50 dark:bg-gray-900">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12" data-aos="fade-up">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">تواصل معنا</h2>
                        <p class="text-xl text-gray-600 dark:text-gray-400">نحن هنا للإجابة على استفساراتك</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg" data-aos="fade-right">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">أرسل رسالة</h3>
                            <form>
                                <div class="mb-4">
                                    <label for="name" class="block text-gray-700 dark:text-gray-300 mb-2">الاسم</label>
                                    <input type="text" id="name" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:text-white">
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="block text-gray-700 dark:text-gray-300 mb-2">البريد الإلكتروني</label>
                                    <input type="email" id="email" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:text-white">
                                </div>
                                <div class="mb-4">
                                    <label for="message" class="block text-gray-700 dark:text-gray-300 mb-2">الرسالة</label>
                                    <textarea id="message" rows="4" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:text-white"></textarea>
                                </div>
                                <button type="submit" class="w-full bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-600 hover:to-emerald-700 text-white px-6 py-3 rounded-lg font-medium transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1">إرسال الرسالة</button>
                            </form>
                        </div>
                        <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg" data-aos="fade-left">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">معلومات التواصل</h3>
                            <div class="space-y-6">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="text-gray-700 dark:text-gray-300 font-medium">البريد الإلكتروني</p>
                                        <p class="text-gray-600 dark:text-gray-400">info@volunteer-platform.com</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="text-gray-700 dark:text-gray-300 font-medium">رقم الهاتف</p>
                                        <p class="text-gray-600 dark:text-gray-400">+966 12 345 6789</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="text-gray-700 dark:text-gray-300 font-medium">العنوان</p>
                                        <p class="text-gray-600 dark:text-gray-400">الرياض، المملكة العربية السعودية</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-8">
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4">تابعنا على</h4>
                                <div class="flex space-x-4 space-x-reverse">
                                    <a href="#" class="bg-gray-100 dark:bg-gray-700 p-2 rounded-full text-teal-600 dark:text-teal-400 hover:bg-teal-100 dark:hover:bg-teal-900 transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                        </svg>
                                    </a>
                                    <a href="#" class="bg-gray-100 dark:bg-gray-700 p-2 rounded-full text-teal-600 dark:text-teal-400 hover:bg-teal-100 dark:hover:bg-teal-900 transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                        </svg>
                                    </a>
                                    <a href="#" class="bg-gray-100 dark:bg-gray-700 p-2 rounded-full text-teal-600 dark:text-teal-400 hover:bg-teal-100 dark:hover:bg-teal-900 transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    </div>
    </div>

    <!-- قسم معرض الصور -->
    <div class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">لحظات من حملاتنا</h2>
                <p class="text-xl text-gray-600 dark:text-gray-400">صور من الحملات التطوعية السابقة</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <div class="relative overflow-hidden rounded-lg shadow-lg group" data-aos="zoom-in" data-aos-delay="100">
                    <img src="{{ asset('images/gallery/volunteer1.jpg') }}" alt="متطوعون" class="w-full h-64 object-cover transition duration-500 transform group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end">
                        <div class="p-4 text-white">
                            <h3 class="font-bold">حملة تنظيف الشواطئ</h3>
                            <p class="text-sm">يونيو 2023</p>
                        </div>
                    </div>
                </div>
                <div class="relative overflow-hidden rounded-lg shadow-lg group" data-aos="zoom-in" data-aos-delay="200">
                    <img src="{{ asset('images/gallery/volunteer2.jpg') }}" alt="متطوعون" class="w-full h-64 object-cover transition duration-500 transform group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end">
                        <div class="p-4 text-white">
                            <h3 class="font-bold">حملة التشجير</h3>
                            <p class="text-sm">مارس 2023</p>
                        </div>
                    </div>
                </div>
                <div class="relative overflow-hidden rounded-lg shadow-lg group" data-aos="zoom-in" data-aos-delay="300">
                    <img src="{{ asset('images/gallery/volunteer3.jpg') }}" alt="متطوعون" class="w-full h-64 object-cover transition duration-500 transform group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end">
                        <div class="p-4 text-white">
                            <h3 class="font-bold">حملة التبرع بالدم</h3>
                            <p class="text-sm">أبريل 2023</p>
                        </div>
                    </div>
                </div>
                <div class="relative overflow-hidden rounded-lg shadow-lg group" data-aos="zoom-in" data-aos-delay="400">
                    <img src="{{ asset('images/gallery/volunteer4.jpg') }}" alt="متطوعون" class="w-full h-64 object-cover transition duration-500 transform group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end">
                        <div class="p-4 text-white">
                            <h3 class="font-bold">حملة تعليم الأطفال</h3>
                            <p class="text-sm">مايو 2023</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-10" data-aos="fade-up">
                <a href="{{ route('campaigns.index') }}" class="inline-block bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-600 hover:to-emerald-700 text-white px-6 py-3 rounded-lg font-medium transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1">عرض المزيد من الصور</a>
            </div>
        </div>
    </div>

    <!-- قسم الشركاء -->
    <div class="py-16 bg-white dark:bg-gray-800">

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-xl font-bold mb-4">منصة التطوع</h3>
                        <p class="text-gray-400 mb-4">منصة تربط المتطوعين بالفرص التطوعية في جميع أنحاء المملكة</p>
                        <div class="flex space-x-4 space-x-reverse">
                            <a href="#" class="text-gray-400 hover:text-teal-500 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-teal-500 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-teal-500 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-4">روابط سريعة</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-teal-500 transition duration-300">الرئيسية</a></li>
                            <li><a href="{{ route('campaigns.index') }}" class="text-gray-400 hover:text-teal-500 transition duration-300">الحملات التطوعية</a></li>
                            <li><a href="{{ url('/about') }}" class="text-gray-400 hover:text-teal-500 transition duration-300">من نحن</a></li>
                            <li><a href="{{ url('/contact') }}" class="text-gray-400 hover:text-teal-500 transition duration-300">اتصل بنا</a></li>
                            <li><a href="{{ url('/faq') }}" class="text-gray-400 hover:text-teal-500 transition duration-300">الأسئلة الشائعة</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-4">الفئات</h3>
                        <ul class="space-y-2">
                            @foreach(\App\Models\Category::take(5)->get() as $category)
                            <li><a href="{{ route('campaigns.index', ['category' => $category->id]) }}" class="text-gray-400 hover:text-teal-500 transition duration-300">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-4">النشرة البريدية</h3>
                        <p class="text-gray-400 mb-4">اشترك في نشرتنا البريدية للحصول على آخر الأخبار والحملات التطوعية</p>
                        <form class="flex">
                            <input type="email" placeholder="البريد الإلكتروني" class="px-4 py-2 w-full rounded-r-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-l-lg transition duration-300">اشتراك</button>
                        </form>
                    </div>
                </div>
                <div class="border-t border-gray-800 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                    <div class="text-gray-400 mb-4 md:mb-0">
                        &copy; {{ date('Y') }} منصة التطوع. جميع الحقوق محفوظة.
                    </div>
                    <div class="flex space-x-4 space-x-reverse">
                        <a href="{{ url('/privacy') }}" class="text-gray-400 hover:text-teal-500 transition duration-300">سياسة الخصوصية</a>
                        <a href="{{ url('/terms') }}" class="text-gray-400 hover:text-teal-500 transition duration-300">شروط الاستخدام</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- سكريبت Swiper -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- سكريبت AOS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <script>
        // تهيئة AOS
        AOS.init({
            duration: 800,
            once: true,
        });

        // تهيئة Swiper للشهادات
        var testimonialSwiper = new Swiper('.testimonialSwiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
            autoplay: {
                delay: 5000,
            },
        });

        // تبديل الوضع المظلم
        const darkModeToggle = document.getElementById('dark-mode-toggle');
        const html = document.documentElement;

        // التحقق من الوضع المحفوظ
        if (localStorage.getItem('darkMode') === 'true' ||
            (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            html.classList.add('dark');
            darkModeToggle.checked = true;
        }

        // تغيير الوضع عند النقر على الزر
        darkModeToggle.addEventListener('change', function() {
            if (this.checked) {
                html.classList.add('dark');
                localStorage.setItem('darkMode', 'true');
            } else {
                html.classList.remove('dark');
                localStorage.setItem('darkMode', 'false');
            }
        });
    </script>
</body>

</html>