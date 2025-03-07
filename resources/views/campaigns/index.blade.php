<x-app-layout>
    <div class="py-12 bg-gradient-to-b from-blue-50 to-white" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg border border-blue-100">
                <div class="px-8 py-6 bg-blue-600 dark:bg-blue-800">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-white">
                                @if(request('type') == 'volunteer')
                                    حملات التطوع
                                @elseif(request('type') == 'help')
                                    حملات المساعدة
                                @else
                                    جميع الحملات
                                @endif
                            </h1>
                            <p class="text-blue-100 mt-2">استعرض الحملات المتاحة وشارك في صنع التغيير</p>
                        </div>
                        
                        <div class="mt-4 md:mt-0 flex space-x-2 space-x-reverse">
                            <a href="{{ route('campaigns.index', ['type' => 'volunteer']) }}" class="px-4 py-2 {{ request('type') == 'volunteer' ? 'bg-white text-blue-700' : 'bg-blue-700 text-white' }} rounded-md hover:bg-opacity-90 transition-colors duration-150 text-sm font-medium">
                                حملات التطوع
                            </a>
                            <a href="{{ route('campaigns.index', ['type' => 'help']) }}" class="px-4 py-2 {{ request('type') == 'help' ? 'bg-white text-blue-700' : 'bg-blue-700 text-white' }} rounded-md hover:bg-opacity-90 transition-colors duration-150 text-sm font-medium">
                                حملات المساعدة
                            </a>
                            <a href="{{ route('campaigns.index') }}" class="px-4 py-2 {{ !request('type') ? 'bg-white text-blue-700' : 'bg-blue-700 text-white' }} rounded-md hover:bg-opacity-90 transition-colors duration-150 text-sm font-medium">
                                الكل
                            </a>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <!-- فلاتر البحث -->
                    <div class="mb-8 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <form action="{{ route('campaigns.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            @if(request('type'))
                                <input type="hidden" name="type" value="{{ request('type') }}">
                            @endif
                            
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">بحث</label>
                                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="ابحث عن حملة..." class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            </div>
                            
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">المنطقة</label>
                                <select name="location" id="location" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                    <option value="">جميع المناطق</option>
                                    <option value="riyadh" {{ request('location') == 'riyadh' ? 'selected' : '' }}>الرياض</option>
                                    <option value="jeddah" {{ request('location') == 'jeddah' ? 'selected' : '' }}>جدة</option>
                                    <option value="dammam" {{ request('location') == 'dammam' ? 'selected' : '' }}>الدمام</option>
                                    <option value="makkah" {{ request('location') == 'makkah' ? 'selected' : '' }}>مكة المكرمة</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">التصنيف</label>
                                <select name="category" id="category" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                    <option value="">جميع التصنيفات</option>
                                    <option value="environment" {{ request('category') == 'environment' ? 'selected' : '' }}>البيئة</option>
                                    <option value="education" {{ request('category') == 'education' ? 'selected' : '' }}>التعليم</option>
                                    <option value="health" {{ request('category') == 'health' ? 'selected' : '' }}>الصحة</option>
                                    <option value="social" {{ request('category') == 'social' ? 'selected' : '' }}>اجتماعي</option>
                                </select>
                            </div>
                            
                            <div class="flex items-end">
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-colors duration-150">
                                    تطبيق الفلتر
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold">الحملات</h1>
                        @auth
                            <a href="{{ url('/test-campaign-create') }}" class="px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                إنشاء حملة جديدة
                            </a>
                        @endauth
                    </div>

                    <!-- عرض الحملات -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($campaigns as $campaign)
                            <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md border border-gray-100 dark:border-gray-700 transition-transform hover:-translate-y-1">
                                <div class="h-48 bg-gray-200 dark:bg-gray-700 relative">
                                    @if($campaign->image)
                                        <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover">
                                    @endif
                                    <div class="absolute top-3 right-3 {{ $campaign->type == 'volunteer' ? 'bg-blue-600' : 'bg-orange-600' }} text-white text-xs font-bold px-3 py-1 rounded-full">
                                        {{ $campaign->type == 'volunteer' ? 'حملة تطوع' : 'حملة مساعدة' }}
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $campaign->title }}</h3>
                                    <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-2">
                                        {{ $campaign->description }}
                                    </p>
                                    <div class="flex justify-between items-center">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            <span>{{ $campaign->start_date->format('Y-m-d') }}</span>
                                        </div>
                                        <a href="{{ route('campaigns.show', $campaign) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium">
                                            التفاصيل &larr;
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full flex flex-col items-center justify-center py-12 px-4 text-center">
                                <div class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">لا توجد حملات متاحة</h3>
                                <p class="text-gray-500 dark:text-gray-400 mb-6">
                                    @if(request('type') == 'volunteer')
                                        لا توجد حملات تطوع متاحة حالياً. يرجى المحاولة مرة أخرى لاحقاً.
                                    @elseif(request('type') == 'help')
                                        لا توجد حملات مساعدة متاحة حالياً. يرجى المحاولة مرة أخرى لاحقاً.
                                    @else
                                        لا توجد حملات متاحة حالياً. يرجى المحاولة مرة أخرى لاحقاً.
                                    @endif
                                </p>
                                <a href="{{ route('campaigns.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-150">
                                    عرض جميع الحملات
                                </a>
                            </div>
                        @endforelse
                    </div>

                    <!-- ترقيم الصفحات -->
                    <div class="mt-8">
                        {{ $campaigns->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>