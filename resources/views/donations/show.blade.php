<x-app-layout>
    <div class="py-12" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-6">
                    <a href="{{ route('donations.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                        &laquo; العودة لسجل التبرعات
                    </a>
                </div>

                <div class="bg-green-50 dark:bg-green-900 p-4 rounded-lg mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-green-800 dark:text-green-200">شكراً لتبرعك!</h3>
                            <div class="mt-2 text-sm text-green-700 dark:text-green-300">
                                <p>تم تسجيل تبرعك بنجاح. يمكنك متابعة تفاصيل التبرع أدناه.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">تفاصيل التبرع</h1>

                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg overflow-hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-6">
                        <div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">رقم التبرع</div>
                            <div class="font-medium text-gray-800 dark:text-white">{{ $donation->id }}</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">الحالة</div>
                            <div class="font-medium">
                                <span class="inline-flex px-2 py-1 text-xs rounded {{ $donation->status == 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $donation->status == 'completed' ? 'مكتمل' : 'معلق' }}
                                </span>
                            </div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">تاريخ التبرع</div>
                            <div class="font-medium text-gray-800 dark:text-white">{{ $donation->created_at->format('Y-m-d H:i:s') }}</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">طريقة الدفع</div>
                            <div class="font-medium text-gray-800 dark:text-white">
                                @if($donation->payment_method == 'credit_card')
                                    بطاقة ائتمان
                                @elseif($donation->payment_method == 'bank_transfer')
                                    تحويل بنكي
                                @elseif($donation->payment_method == 'mada')
                                    مدى
                                @else
                                    {{ $donation->payment_method }}
                                @endif
                            </div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">المبلغ</div>
                            <div class="text-xl font-bold text-blue-600 dark:text-blue-400">{{ number_format($donation->amount, 2) }} ريال</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">تبرع مجهول</div>
                            <div class="font-medium text-gray-800 dark:text-white">{{ $donation->anonymous ? 'نعم' : 'لا' }}</div>
                        </div>
                        
                        @if($donation->message)
                            <div class="md:col-span-2">
                                <div class="text-sm text-gray-500 dark:text-gray-400">رسالتك</div>
                                <div class="mt-1 text-gray-800 dark:text-white">{{ $donation->message }}</div>
                            </div>
                        @endif
                    </div>

                    <div class="border-t border-gray-200 dark:border-gray-600 p-6">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-3">معلومات الحملة</h3>
                        <div class="flex items-center mb-4">
                            @if($donation->campaign->image)
                                <img src="{{ asset('storage/' . $donation->campaign->image) }}" alt="{{ $donation->campaign->title }}" class="w-16 h-16 object-cover rounded mr-4">
                            @else
                                <div class="w-16 h-16 bg-gray-200 dark:bg-gray-600 rounded flex items-center justify-center mr-4">
                                    <span class="text-gray-400 dark:text-gray-500 text-xs">لا توجد صورة</span>
                                </div>
                            @endif
                            <div>
                                <h4 class="font-medium text-gray-800 dark:text-white">{{ $donation->campaign->title }}</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">بواسطة: {{ $donation->campaign->creator->name }}</p>
                            </div>
                        </div>
                        <a href="{{ route('campaigns.show', $donation->campaign) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                            عرض الحملة
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>

                    @if($donation->status === 'completed')
                        <div class="bg-gray-100 dark:bg-gray-600 p-6 border-t border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-3">إيصال التبرع</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-3">يمكنك طباعة إيصال التبرع كمرجع للمستقبل.</p>
                            <a href="{{ route('donations.receipt', $donation) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                </svg>
                                طباعة الإيصال
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
