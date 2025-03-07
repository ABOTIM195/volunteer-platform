<x-app-layout>
    <div class="py-12" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">حملاتي</h1>
                    <a href="{{ route('campaigns.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        إنشاء حملة جديدة
                    </a>
                </div>

                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                @if ($campaigns->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-gray-600 dark:text-gray-400 mb-4">لم تقم بإنشاء أي حملات حتى الآن</p>
                        <a href="{{ url('/test-campaign-create') }}" class="px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            إنشاء حملة جديدة
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($campaigns as $campaign)
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow overflow-hidden">
                                @if ($campaign->image)
                                    <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                        <span class="text-gray-500 dark:text-gray-400">لا توجد صورة</span>
                                    </div>
                                @endif
                                <div class="p-4">
                                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $campaign->title }}</h2>
                                    
                                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mt-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $campaign->start_date }}
                                        @if ($campaign->end_date)
                                            <span class="mx-1">-</span>
                                            {{ $campaign->end_date }}
                                        @endif
                                    </div>
                                    
                                    <div class="flex items-center mt-2">
                                        <span class="px-2 py-1 text-xs rounded {{ $campaign->type === 'volunteer' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                            {{ $campaign->type === 'volunteer' ? 'حملة تطوع' : 'حملة مساعدة' }}
                                        </span>
                                        
                                        <span class="px-2 py-1 text-xs rounded mr-2 {{ $campaign->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $campaign->status === 'active' ? 'نشطة' : 'غير نشطة' }}
                                        </span>
                                    </div>
                                    
                                    <div class="mt-4 flex justify-between">
                                        <a href="{{ route('campaigns.show', $campaign) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                            عرض التفاصيل
                                        </a>
                                        <div>
                                            <a href="{{ route('campaigns.edit', $campaign) }}" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 ml-2">
                                                تعديل
                                            </a>
                                            <form action="{{ route('campaigns.destroy', $campaign) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300" onclick="return confirm('هل أنت متأكد من رغبتك في حذف هذه الحملة؟')">
                                                    حذف
                                                </button>
                                            </form>
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
