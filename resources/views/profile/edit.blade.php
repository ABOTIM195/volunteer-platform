<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            {{ __('الملف الشخصي') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- بطاقة الملف الشخصي الرئيسية -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg mb-8">
                <div class="relative">
                    <!-- غلاف الملف الشخصي -->
                    <div class="h-48 bg-gradient-to-r from-indigo-500 to-purple-600 w-full"></div>
                    
                    <!-- صورة المستخدم والمعلومات الأساسية -->
                    <div class="relative px-6 pb-6">
                        <div class="absolute -top-16 right-10">
                            @if(auth()->user()->avatar)
                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}" class="w-32 h-32 rounded-full object-cover border-4 border-white dark:border-gray-800 shadow-xl">
                            @else
                                <div class="w-32 h-32 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center text-4xl font-bold text-indigo-500 dark:text-indigo-300 border-4 border-white dark:border-gray-800 shadow-xl">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        
                        <div class="pt-20 md:pt-5 md:mr-40">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                <div>
                                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">{{ auth()->user()->name }}</h1>
                                    <p class="text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</p>
                                    <div class="mt-2">
                                        <span class="px-4 py-1 text-sm bg-indigo-100 dark:bg-indigo-900 text-indigo-700 dark:text-indigo-300 rounded-full">
                                            @if(auth()->user()->type === 'regular')
                                                متطوع فردي
                                            @elseif(auth()->user()->type === 'team')
                                                فريق تطوعي
                                            @elseif(auth()->user()->type === 'organization')
                                                منظمة
                                            @endif
                                        </span>
                                        <span class="px-4 py-1 text-sm bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-full mr-2">
                                            {{ auth()->user()->points()->sum('amount') }} نقطة
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="flex mt-4 md:mt-0 space-x-2 space-x-reverse">
                                    <a href="{{ route('campaigns.create') }}" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700">إنشاء حملة جديدة</a>
                                    <a href="{{ route('leaderboard.index') }}" class="px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-100 rounded-md hover:bg-indigo-200 dark:bg-indigo-900 dark:text-indigo-300 dark:hover:bg-indigo-800">لوحة المتصدرين</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- إحصائيات سريعة -->
                <div class="border-t border-gray-200 dark:border-gray-700">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-6">
                        <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ auth()->user()->campaigns()->count() }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">الحملات المنشأة</p>
                        </div>
                        <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ auth()->user()->participations()->where('status', 'approved')->count() }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">المشاركات</p>
                        </div>
                        <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <p class="text-3xl font-bold text-amber-600 dark:text-amber-400">{{ auth()->user()->donations()->count() }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">التبرعات</p>
                        </div>
                        <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <p class="text-3xl font-bold text-purple-600 dark:text-purple-400">{{ auth()->user()->badges()->count() }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">الشارات</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- عرض الشارات -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg mb-8 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                        شاراتي
                    </h3>
                    <a href="#" class="text-sm text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300">عرض الكل</a>
                </div>
                
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
                    @forelse(auth()->user()->getFeaturedBadges(10) as $badge)
                        <div class="text-center p-3">
                            <div class="w-16 h-16 mx-auto bg-gradient-to-r from-yellow-400 to-amber-500 rounded-full flex items-center justify-center">
                                <span class="text-2xl text-white">{{ $badge->badge->emoji }}</span>
                            </div>
                            <h4 class="mt-2 font-semibold text-gray-800 dark:text-white">{{ $badge->badge->name }}</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $badge->created_at->format('Y-m-d') }}</p>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-8">
                            <p class="text-gray-500 dark:text-gray-400">لم تحصل على أي شارات بعد. شارك في المزيد من الحملات التطوعية لكسب الشارات!</p>
                        </div>
                    @endforelse
                </div>
            </div>
            
            <!-- أقسام تعديل الملف الشخصي -->
            <div class="grid md:grid-cols-2 gap-8">
                <!-- معلومات الملف الشخصي -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white flex items-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        معلومات الملف الشخصي
                    </h3>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
                
                <!-- تغيير كلمة المرور -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white flex items-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        أمان الحساب
                    </h3>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
            
            <!-- حذف الحساب -->
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-red-600 dark:text-red-400 flex items-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        حذف الحساب
                    </h3>
                    <div class="bg-red-50 dark:bg-red-900/20 rounded-lg border border-red-200 dark:border-red-800/30">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
