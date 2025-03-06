<x-app-layout>
    <div class="py-12 bg-gradient-to-b from-blue-50 to-white" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg border border-blue-100">
                <div class="px-8 py-6 bg-blue-600 dark:bg-blue-800">
                    <h1 class="text-2xl font-bold text-white">طلبات المشاركة المرسلة</h1>
                    <p class="text-blue-100 mt-2">متابعة حالة طلبات المشاركة في الحملات التطوعية</p>
                </div>

                @if($requests->isEmpty())
                    <div class="flex flex-col items-center justify-center py-16 px-6 text-center">
                        <div class="w-24 h-24 rounded-full bg-blue-100 flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-2">لم تقم بإرسال أي طلبات مشاركة حتى الآن</h2>
                        <p class="text-gray-600 dark:text-gray-400 mb-8 max-w-md">يمكنك المشاركة في حملات المساعدة والتطوع من خلال تصفح الحملات المتاحة وإرسال طلب المشاركة</p>
                        <a href="{{ route('campaigns.index', ['type' => 'help']) }}" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg shadow-md hover:bg-blue-700 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                            </svg>
                            استعرض حملات المساعدة
                        </a>
                    </div>
                @else
                    <div class="p-6">
                        <div class="mb-6 bg-blue-50 dark:bg-gray-700 rounded-lg p-4 border-r-4 border-blue-600">
                            <div class="flex items-center">
                                <div class="text-blue-600 dark:text-blue-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="mr-3">
                                    <p class="text-sm text-gray-700 dark:text-gray-300">يمكنك متابعة حالة طلبات المشاركة الخاصة بك هنا وسحب الطلبات المعلقة في حالة تغيير رأيك</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                            <div class="overflow-x-auto relative">
                                <table class="w-full text-sm text-right">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                                        <tr>
                                            <th scope="col" class="py-4 px-6 rounded-tr-lg">رقم الطلب</th>
                                            <th scope="col" class="py-4 px-6">الحملة</th>
                                            <th scope="col" class="py-4 px-6">المنظمة</th>
                                            <th scope="col" class="py-4 px-6">تاريخ الطلب</th>
                                            <th scope="col" class="py-4 px-6">الحالة</th>
                                            <th scope="col" class="py-4 px-6 rounded-tl-lg">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($requests as $request)
                                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                                <td class="py-4 px-6 font-medium">#{{ $request->id }}</td>
                                                <td class="py-4 px-6">
                                                    <a href="{{ route('campaigns.show', $request->campaign) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium">
                                                        {{ $request->campaign->title }}
                                                    </a>
                                                </td>
                                                <td class="py-4 px-6">
                                                    <div class="flex items-center">
                                                        <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold ml-2">
                                                            {{ substr($request->campaign->creator->name, 0, 1) }}
                                                        </div>
                                                        <span>{{ $request->campaign->creator->name }}</span>
                                                    </div>
                                                </td>
                                                <td class="py-4 px-6">{{ $request->created_at->format('Y-m-d') }} <span class="text-xs text-gray-500">{{ $request->created_at->format('H:i') }}</span></td>
                                                <td class="py-4 px-6">
                                                    @if($request->status === 'pending')
                                                        <span class="px-3 py-1 text-sm rounded-full font-medium bg-yellow-100 text-yellow-800">معلق</span>
                                                    @elseif($request->status === 'approved')
                                                        <span class="px-3 py-1 text-sm rounded-full font-medium bg-green-100 text-green-800">مقبول</span>
                                                    @elseif($request->status === 'rejected')
                                                        <span class="px-3 py-1 text-sm rounded-full font-medium bg-red-100 text-red-800">مرفوض</span>
                                                    @endif
                                                </td>
                                                <td class="py-4 px-6">
                                                    <div class="flex items-center space-x-3 space-x-reverse">
                                                        <a href="{{ route('participation-requests.show', $request) }}" class="px-3 py-1 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 transition-colors duration-150">
                                                            <span class="flex items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                                </svg>
                                                                التفاصيل
                                                            </span>
                                                        </a>
                                                        
                                                        @if($request->status === 'pending')
                                                            <form action="{{ route('participation-requests.destroy', $request) }}" method="POST" class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition-colors duration-150" onclick="return confirm('هل أنت متأكد من رغبتك في سحب هذا الطلب؟')">
                                                                    <span class="flex items-center">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                        </svg>
                                                                        سحب
                                                                    </span>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mt-6">
                            {{ $requests->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
