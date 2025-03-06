<x-app-layout>
    <div class="py-12" dir="rtl">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">إيصال التبرع</h1>
                    <p class="text-gray-600 dark:text-gray-400">رقم العملية: {{ $donation->transaction_id }}</p>
                </div>

                <div class="border-t border-b border-gray-200 py-4 mb-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400">المتبرع:</p>
                            <p class="font-semibold text-gray-900 dark:text-white">
                                {{ $donation->is_anonymous ? 'متبرع مجهول' : $donation->user->name }}
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-600 dark:text-gray-400">تاريخ التبرع:</p>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $donation->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 dark:text-gray-400">المبلغ:</p>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ number_format($donation->amount, 2) }} ريال</p>
                        </div>
                        <div>
                            <p class="text-gray-600 dark:text-gray-400">طريقة الدفع:</p>
                            <p class="font-semibold text-gray-900 dark:text-white">
                                @if($donation->payment_method === 'credit_card')
                                    بطاقة ائتمان
                                @elseif($donation->payment_method === 'bank_transfer')
                                    تحويل بنكي
                                @elseif($donation->payment_method === 'paypal')
                                    باي بال
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">معلومات الحملة</h2>
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded">
                        <h3 class="font-semibold text-gray-900 dark:text-white">{{ $donation->campaign->title }}</h3>
                        <p class="text-gray-600 dark:text-gray-400 mt-2">منظم الحملة: {{ $donation->campaign->creator->name }}</p>
                    </div>
                </div>

                @if($donation->message)
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">رسالة المتبرع</h2>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded">
                            <p class="text-gray-600 dark:text-gray-400">{{ $donation->message }}</p>
                        </div>
                    </div>
                @endif

                <div class="text-center mt-8">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">شكراً لتبرعك! مساهمتك ستساعد في تحقيق أهداف هذه الحملة.</p>
                    
                    <div class="flex justify-center space-x-4">
                        <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            طباعة الإيصال
                        </button>
                        <a href="{{ route('donations.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            العودة إلى تبرعاتي
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
