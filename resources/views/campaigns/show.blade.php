<a href="{{ route('campaigns.index') }}" class="absolute top-4 right-4 bg-white/20 hover:bg-white/30 text-white rounded-full p-2 backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                </div>
                
                <!-- محتوى الحملة -->
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- القسم الرئيسي -->
                        <div class="lg:col-span-2">
                            <!-- تفاصيل الحملة -->
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 p-6 mb-6">
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">تفاصيل الحملة</h2>
                                <div class="prose dark:prose-invert max-w-none">
                                    <p>{{ $campaign->description }}</p>
                                </div>
                            </div>
                            
                            <!-- أهداف الحملة -->
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 p-6 mb-6">
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">أهداف الحملة</h2>
                                <ul class="space-y-3">
                                    @if($campaign->goals)
                                        @foreach(explode("\n", $campaign->goals) as $goal)
                                            <li class="flex items-start">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 dark:text-blue-400 ml-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="text-gray-700 dark:text-gray-300">{{ $goal }}</span>
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="text-gray-500 dark:text-gray-400">لم يتم تحديد أهداف للحملة</li>
                                    @endif
                                </ul>
                            </div>
                            
                            <!-- المهارات المطلوبة -->
                            @if($campaign->type == 'volunteer')
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 p-6 mb-6">
                                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">المهارات المطلوبة</h2>
                                    <div class="flex flex-wrap gap-2">
                                        @if($campaign->skills)
                                            @foreach(explode(',', $campaign->skills) as $skill)
                                                <span class="bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 text-sm font-medium px-3 py-1 rounded-full">
                                                    {{ trim($skill) }}
                                                </span>
                                            @endforeach
                                        @else
                                            <p class="text-gray-500 dark:text-gray-400">لا توجد مهارات محددة مطلوبة</p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            
                            <!-- المساعدات المطلوبة -->
                            @if($campaign->type == 'help')
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 p-6 mb-6">
                                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">المساعدات المطلوبة</h2>
                                    <ul class="space-y-3">
                                        @if($campaign->needs)
                                            @foreach(explode("\n", $campaign->needs) as $need)
                                                <li class="flex items-start">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-600 dark:text-orange-400 ml-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="text-gray-700 dark:text-gray-300">{{ $need }}</span>
                                                </li>
                                            @endforeach
                                        @else
                                            <li class="text-gray-500 dark:text-gray-400">لم يتم تحديد احتياجات للحملة</li>
                                        @endif
                                    </ul>
                                </div>
                            @endif
                            
                            <!-- الموقع -->
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 p-6 mb-6">
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">موقع الحملة</h2>
                                <div class="flex items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400 ml-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <div>
                                        <p class="text-gray-700 dark:text-gray-300">{{ $campaign->location ?? 'لم يتم تحديد الموقع' }}</p>
                                        @if($campaign->location_details)
                                            <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">{{ $campaign->location_details }}</p>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- هنا يمكن إضافة خريطة إذا كانت متوفرة -->
                            </div>
                        </div>
                        
                        <!-- القسم الجانبي -->
                        <div class="lg:col-span-1">
                            <!-- معلومات المنظم -->
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 p-6 mb-6">
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">منظم الحملة</h2>
                                <div class="flex items-center">
                                    <div class="h-12 w-12 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                        @if($campaign->organizer && $campaign->organizer->profile_photo_path)
                                            <img src="{{ asset('storage/' . $campaign->organizer->profile_photo_path) }}" alt="{{ $campaign->organizer->name }}" class="h-12 w-12 rounded-full object-cover">
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="mr-3">
                                        <h3 class="font-medium text-gray-900 dark:text-white">
                                            {{ $campaign->organizer->name ?? 'غير معروف' }}
                                        </h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $campaign->organization ?? 'منظم مستقل' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- معلومات الحملة -->
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 p-6 mb-6">
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">معلومات الحملة</h2>
                                <ul class="space-y-4">
                                    <li class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400 ml-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">تاريخ البداية</p>
                                            <p class="text-gray-700 dark:text-gray-300">{{ $campaign->start_date->format('Y-m-d') }}</p>
                                        </div>
                                    </li>
                                    @if($campaign->end_date)
                                        <li class="flex items-start">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400 ml-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <div>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">تاريخ النهاية</p>
                                                <p class="text-gray-700 dark:text-gray-300">{{ $campaign->end_date->format('Y-m-d') }}</p>
                                            </div>
                                        </li>
                                    @endif
                                    <li class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400 ml-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">عدد المتطوعين المطلوب</p>
                                            <p class="text-gray-700 dark:text-gray-300">{{ $campaign->volunteers_needed ?? 'غير محددة' }}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>