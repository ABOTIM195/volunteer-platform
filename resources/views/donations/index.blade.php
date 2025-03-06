<x-app-layout>
    <div class="py-12" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">سجل التبرعات</h1>
                </div>

                @if($donations->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-gray-600 dark:text-gray-400">لا توجد تبرعات في سجلك حتى الآن</p>
                        <a href="{{ route('campaigns.index') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            استعرض الحملات
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto relative">
                        <table class="w-full text-sm text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">رقم التبرع</th>
                                    <th scope="col" class="py-3 px-6">الحملة</th>
                                    <th scope="col" class="py-3 px-6">المبلغ</th>
                                    <th scope="col" class="py-3 px-6">التاريخ</th>
                                    <th scope="col" class="py-3 px-6">الحالة</th>
                                    <th scope="col" class="py-3 px-6">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($donations as $donation)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="py-4 px-6">{{ $donation->id }}</td>
                                        <td class="py-4 px-6">
                                            <a href="{{ route('campaigns.show', $donation->campaign) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                {{ $donation->campaign->title }}
                                            </a>
                                        </td>
                                        <td class="py-4 px-6">{{ number_format($donation->amount, 2) }} ريال</td>
                                        <td class="py-4 px-6">{{ $donation->created_at->format('Y-m-d H:i') }}</td>
                                        <td class="py-4 px-6">
                                            <span class="px-2 py-1 text-xs rounded {{ $donation->status == 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ $donation->status == 'completed' ? 'مكتمل' : 'معلق' }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <a href="{{ route('donations.show', $donation) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                عرض التفاصيل
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $donations->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
