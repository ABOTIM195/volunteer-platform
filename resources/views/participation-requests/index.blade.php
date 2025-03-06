<x-app-layout>
    <div class="py-12" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                        @if(Auth::user()->isOrganization())
                            طلبات المشاركة الواردة
                        @else
                            طلبات المشاركة المرسلة
                        @endif
                    </h1>
                </div>

                @if($participationRequests->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-gray-600 dark:text-gray-400">
                            @if(Auth::user()->isOrganization())
                                لا توجد طلبات مشاركة واردة حالياً
                            @else
                                لم تقم بإرسال أي طلبات مشاركة حتى الآن
                            @endif
                        </p>
                        @if(!Auth::user()->isOrganization())
                            <a href="{{ route('campaigns.index', ['type' => 'help']) }}" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                استعرض حملات المساعدة
                            </a>
                        @endif
                    </div>
                @else
                    <div class="overflow-x-auto relative">
                        <table class="w-full text-sm text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">رقم الطلب</th>
                                    @if(Auth::user()->isOrganization())
                                        <th scope="col" class="py-3 px-6">المتطوع</th>
                                    @endif
                                    <th scope="col" class="py-3 px-6">الحملة</th>
                                    <th scope="col" class="py-3 px-6">تاريخ الطلب</th>
                                    <th scope="col" class="py-3 px-6">الحالة</th>
                                    <th scope="col" class="py-3 px-6">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($participationRequests as $request)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="py-4 px-6">{{ $request->id }}</td>
                                        @if(Auth::user()->isOrganization())
                                            <td class="py-4 px-6">{{ $request->user->name }}</td>
                                        @endif
                                        <td class="py-4 px-6">
                                            <a href="{{ route('campaigns.show', $request->campaign) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                {{ $request->campaign->title }}
                                            </a>
                                        </td>
                                        <td class="py-4 px-6">{{ $request->created_at->format('Y-m-d H:i') }}</td>
                                        <td class="py-4 px-6">
                                            @if($request->status === 'pending')
                                                <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-800">معلق</span>
                                            @elseif($request->status === 'approved')
                                                <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800">مقبول</span>
                                            @elseif($request->status === 'rejected')
                                                <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-800">مرفوض</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6">
                                            <a href="{{ route('participation-requests.show', $request) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                عرض التفاصيل
                                            </a>
                                            
                                            @if(Auth::user()->isOrganization() && $request->status === 'pending')
                                                <form action="{{ route('participation-requests.approve', $request) }}" method="POST" class="inline mr-2">
                                                    @csrf
                                                    <button type="submit" class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300">
                                                        قبول
                                                    </button>
                                                </form>
                                                <form action="{{ route('participation-requests.reject', $request) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                                        رفض
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $participationRequests->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
