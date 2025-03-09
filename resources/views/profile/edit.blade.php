<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- بطاقة الملف الشخصي الرئيسية -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg mb-6">
                <div class="relative">
                    <!-- صورة الغلاف -->
                    <div class="h-48 bg-gradient-to-r from-blue-500 to-teal-400"></div>
                    
                    <!-- صورة الملف الشخصي -->
                    <div class="absolute bottom-0 left-10 transform translate-y-1/2 rtl:left-auto rtl:right-10">
                        <div class="relative group">
                            <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-white dark:border-gray-800 shadow-xl bg-white dark:bg-gray-700">
                                @if(Auth::user()->profile_photo_path)
                                    <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200 dark:bg-gray-600">
                                        <span class="text-4xl text-gray-500 dark:text-gray-400">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="p-6 pt-20">
                    <div class="flex flex-col md:flex-row">
                        <!-- معلومات المستخدم -->
                        <div class="md:w-1/3 mb-6 md:mb-0 text-right">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ Auth::user()->name }}</h2>
                            <p class="text-gray-600 dark:text-gray-400">{{ Auth::user()->email }}</p>
                            
                            @if(Auth::user()->city)
                                <div class="flex items-center mt-2 text-gray-600 dark:text-gray-400 justify-end">
                                    <span>{{ Auth::user()->city }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            @endif
                            
                            @if(Auth::user()->phone)
                                <div class="flex items-center mt-2 text-gray-600 dark:text-gray-400 justify-end">
                                    <span dir="ltr">{{ Auth::user()->phone }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                            @endif
                            
                            @if(Auth::user()->bio)
                                <div class="mt-4 text-right">
                                    <h3 class="text-md font-semibold text-gray-900 dark:text-white mb-2">نبذة عني</h3>
                                    <p class="text-gray-600 dark:text-gray-400">{{ Auth::user()->bio }}</p>
                                </div>
                            @endif
                        </div>
                        
                        <!-- إحصائيات المستخدم -->
                        <div class="md:w-2/3 md:pr-6 rtl:md:pr-0 rtl:md:pl-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 text-right border-r-4 border-blue-500 pr-2">إحصائيات النشاط</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="bg-white dark:bg-gray-700 p-4 rounded-lg text-center shadow-md border-r-4 border-blue-500 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                                    <div class="flex flex-col items-center">
                                        <div class="rounded-full bg-blue-100 dark:bg-blue-900 p-3 mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 dark:text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </div>
                                        <span class="block text-3xl font-bold text-blue-600 dark:text-blue-300">{{ Auth::user()->participationRequests()->where('status', 'approved')->count() }}</span>
                                        <span class="text-sm text-gray-600 dark:text-gray-300">مشاركات</span>
                                    </div>
                                </div>
                                
                                <div class="bg-white dark:bg-gray-700 p-4 rounded-lg text-center shadow-md border-r-4 border-green-500 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                                    <div class="flex flex-col items-center">
                                        <div class="rounded-full bg-green-100 dark:bg-green-900 p-3 mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 dark:text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                        </div>
                                        <span class="block text-3xl font-bold text-green-600 dark:text-green-300">{{ Auth::user()->badges()->count() }}</span>
                                        <span class="text-sm text-gray-600 dark:text-gray-300">شارات</span>
                                    </div>
                                </div>
                                
                                <div class="bg-white dark:bg-gray-700 p-4 rounded-lg text-center shadow-md border-r-4 border-purple-500 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                                    <div class="flex flex-col items-center">
                                        <div class="rounded-full bg-purple-100 dark:bg-purple-900 p-3 mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600 dark:text-purple-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                            </svg>
                                        </div>
                                        <span class="block text-3xl font-bold text-purple-600 dark:text-purple-300">{{ Auth::user()->comments()->count() }}</span>
                                        <span class="text-sm text-gray-600 dark:text-gray-300">تعليقات</span>
                                    </div>
                                </div>
                                
                                <div class="bg-white dark:bg-gray-700 p-4 rounded-lg text-center shadow-md border-r-4 border-amber-500 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                                    <div class="flex flex-col items-center">
                                        <div class="rounded-full bg-amber-100 dark:bg-amber-900 p-3 mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600 dark:text-amber-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        </div>
                                        <span class="block text-3xl font-bold text-amber-600 dark:text-amber-300">{{ Auth::user()->likes()->count() }}</span>
                                        <span class="text-sm text-gray-600 dark:text-gray-300">إعجابات</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- تبويبات الإعدادات -->
            <div x-data="{ activeTab: 'profile' }" class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                        <li class="ml-2">
                            <button @click="activeTab = 'profile'" :class="{'text-blue-600 border-blue-600 dark:text-blue-400 dark:border-blue-400': activeTab === 'profile', 'text-gray-500 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'profile'}" class="inline-block p-4 border-b-2 rounded-t-lg">
                                تعديل الملف الشخصي
                            </button>
                        </li>
                        <li class="ml-2">
                            <button @click="activeTab = 'password'" :class="{'text-blue-600 border-blue-600 dark:text-blue-400 dark:border-blue-400': activeTab === 'password', 'text-gray-500 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'password'}" class="inline-block p-4 border-b-2 rounded-t-lg">
                                تغيير كلمة المرور
                            </button>
                        </li>
                        <li>
                            <button @click="activeTab = 'delete'" :class="{'text-red-600 border-red-600 dark:text-red-400 dark:border-red-400': activeTab === 'delete', 'text-gray-500 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'delete'}" class="inline-block p-4 border-b-2 rounded-t-lg">
                                حذف الحساب
                            </button>
                        </li>
                    </ul>
                </div>
                
                <div class="p-6">
                    <!-- تعديل الملف الشخصي -->
                    <div x-show="activeTab === 'profile'">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                    
                    <!-- تغيير كلمة المرور -->
                    <div x-show="activeTab === 'password'" x-cloak>
                        @include('profile.partials.update-password-form')
                    </div>
                    
                    <!-- حذف الحساب -->
                    <div x-show="activeTab === 'delete'" x-cloak>
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        [x-cloak] { display: none !important; }
        /* إضافة دعم RTL للصفحة */
        html[dir="rtl"] .rtl\:left-auto { left: auto; }
        html[dir="rtl"] .rtl\:right-10 { right: 2.5rem; }
    </style>
</x-app-layout>