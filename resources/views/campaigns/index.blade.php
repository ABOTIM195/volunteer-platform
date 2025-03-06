<x-app-layout>
    <div class="py-12" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                        @if(request()->type == 'volunteer')
                            حملات التطوع
                        @elseif(request()->type == 'help')
                            حملات المساعدة
                        @else
                            جميع الحملات
                        @endif
                    </h1>
                    <div>
                        @auth
                            @if(Auth::user()->isTeam() || Auth::user()->isOrganization())
                                <a href="{{ route('campaigns.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    إنشاء حملة جديدة
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>

                <!-- Filter Form -->
                <div class="mb-6">
                    <form action="{{ route('campaigns.index') }}" method="GET" class="flex flex-wrap gap-4">
                        <div>
                            <select name="type" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">جميع الحملات</option>
                                <option value="volunteer" {{ request()->type == 'volunteer' ? 'selected' : '' }}>حملات التطوع</option>
                                <option value="help" {{ request()->type == 'help' ? 'selected' : '' }}>حملات المساعدة</option>
                            </select>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-md hover:bg-gray-400 dark:hover:bg-gray-600">
                            تصفية
                        </button>
                    </form>
                </div>

                @if($campaigns->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-gray-600 dark:text-gray-400">لا توجد حملات متاحة حالياً</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($campaigns as $campaign)
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden">
                                @if($campaign->image)
                                    <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                        <span class="text-gray-400 dark:text-gray-500">لا توجد صورة</span>
                                    </div>
                                @endif
                                <div class="p-4">
                                    <div class="flex justify-between items-start">
                                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $campaign->title }}</h2>
                                        <span class="text-xs px-2 py-1 rounded {{ $campaign->type == 'volunteer' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ $campaign->type == 'volunteer' ? 'حملة تطوع' : 'حملة مساعدة' }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">{{ Str::limit($campaign->description, 100) }}</p>
                                    
                                    <div class="mt-3 text-sm text-gray-500 dark:text-gray-400">
                                        <p>بواسطة: {{ $campaign->creator->name }}</p>
                                        <p>تاريخ البدء: {{ $campaign->start_date->format('Y-m-d') }}</p>
                                        @if($campaign->target_amount)
                                            <div class="mt-2">
                                                <div class="flex justify-between mb-1">
                                                    <span class="text-xs">{{ number_format($campaign->current_amount, 2) }} من {{ number_format($campaign->target_amount, 2) }} ريال</span>
                                                    <span class="text-xs">{{ round(($campaign->current_amount / $campaign->target_amount) * 100) }}%</span>
                                                </div>
                                                <div class="w-full bg-gray-200 rounded-full h-2">
                                                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ min(($campaign->current_amount / $campaign->target_amount) * 100, 100) }}%"></div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="mt-4 flex justify-between">
                                        <a href="{{ route('campaigns.show', $campaign) }}" class="inline-flex items-center px-3 py-1 text-sm bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700">
                                            عرض التفاصيل
                                        </a>
                                        <div class="flex items-center space-x-2">
                                            <span class="flex items-center text-gray-500 dark:text-gray-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                </svg>
                                                {{ $campaign->likes()->count() }}
                                            </span>
                                            <span class="flex items-center text-gray-500 dark:text-gray-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                </svg>
                                                {{ $campaign->comments()->count() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $campaigns->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
