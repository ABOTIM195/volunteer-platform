<x-app-layout>
    <div class="py-12" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-6">
                    <a href="{{ route('campaigns.show', $campaign) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                        &laquo; العودة للحملة
                    </a>
                </div>

                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Campaign Summary -->
                    <div class="md:w-1/3">
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">ملخص الحملة</h2>
                            <h3 class="text-lg font-medium text-gray-800 dark:text-white">{{ $campaign->title }}</h3>
                            <p class="text-gray-600 dark:text-gray-300 mt-2">{{ Str::limit($campaign->description, 150) }}</p>
                            
                            @if($campaign->target_amount)
                                <div class="mt-4">
                                    <div class="flex justify-between mb-1">
                                        <span class="text-sm">{{ number_format($campaign->current_amount, 2) }} من {{ number_format($campaign->target_amount, 2) }} ريال</span>
                                        <span class="text-sm">{{ round(($campaign->current_amount / $campaign->target_amount) * 100) }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full" style="width: {{ min(($campaign->current_amount / $campaign->target_amount) * 100, 100) }}%"></div>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                                <p>بواسطة: {{ $campaign->creator->name }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Donation Form -->
                    <div class="md:w-2/3">
                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">تبرع للحملة</h2>

                        <form action="{{ route('donations.store', $campaign) }}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="amount" value="مبلغ التبرع (ريال)" />
                                    <x-text-input id="amount" name="amount" type="number" step="0.01" min="1" class="mt-1 block w-full" value="{{ old('amount', 100) }}" required />
                                    <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="payment_method" value="طريقة الدفع" />
                                    <select id="payment_method" name="payment_method" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                        <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>بطاقة ائتمان</option>
                                        <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>تحويل بنكي</option>
                                        <option value="mada" {{ old('payment_method') == 'mada' ? 'selected' : '' }}>مدى</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="message" value="رسالة (اختياري)" />
                                    <textarea id="message" name="message" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('message') }}</textarea>
                                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                                </div>

                                <div class="mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="anonymous" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" {{ old('anonymous') ? 'checked' : '' }}>
                                        <span class="mr-2 text-sm text-gray-600 dark:text-gray-400">التبرع كمجهول</span>
                                    </label>
                                </div>

                                <!-- Payment details -->
                                <div id="credit_card_details" class="border p-4 rounded-md mt-4">
                                    <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-3">معلومات الدفع</h3>
                                    <div class="space-y-3">
                                        <div>
                                            <x-input-label for="card_number" value="رقم البطاقة" />
                                            <x-text-input id="card_number" name="card_number" type="text" placeholder="0000 0000 0000 0000" class="mt-1 block w-full" value="{{ old('card_number') }}" />
                                            <x-input-error :messages="$errors->get('card_number')" class="mt-2" />
                                        </div>
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <x-input-label for="expiry" value="تاريخ الانتهاء" />
                                                <x-text-input id="expiry" name="expiry" type="text" placeholder="MM/YY" class="mt-1 block w-full" value="{{ old('expiry') }}" />
                                                <x-input-error :messages="$errors->get('expiry')" class="mt-2" />
                                            </div>
                                            <div>
                                                <x-input-label for="cvc" value="رمز التحقق" />
                                                <x-text-input id="cvc" name="cvc" type="text" placeholder="CVC" class="mt-1 block w-full" value="{{ old('cvc') }}" />
                                                <x-input-error :messages="$errors->get('cvc')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div>
                                            <x-input-label for="card_name" value="الاسم على البطاقة" />
                                            <x-text-input id="card_name" name="card_name" type="text" class="mt-1 block w-full" value="{{ old('card_name') }}" />
                                            <x-input-error :messages="$errors->get('card_name')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>

                                <div id="bank_transfer_details" class="border p-4 rounded-md mt-4 hidden">
                                    <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-3">تعليمات التحويل البنكي</h3>
                                    <p class="text-gray-600 dark:text-gray-300 mb-3">الرجاء تحويل المبلغ إلى الحساب التالي:</p>
                                    <div class="space-y-2 text-gray-800 dark:text-gray-200">
                                        <p>اسم البنك: بنك الراجحي</p>
                                        <p>رقم الحساب: SA123456789012345678</p>
                                        <p>اسم المستفيد: مؤسسة حملات التطوع</p>
                                        <p>الرجاء إضافة رقم الحملة <strong>{{ $campaign->id }}</strong> في تفاصيل التحويل.</p>
                                    </div>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                                        بالضغط على زر "تبرع الآن"، أنت توافق على <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">شروط وأحكام</a> منصة التطوع.
                                    </p>
                                </div>

                                <div class="flex justify-end">
                                    <x-primary-button>
                                        تبرع الآن
                                    </x-primary-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentMethod = document.getElementById('payment_method');
            const creditCardDetails = document.getElementById('credit_card_details');
            const bankTransferDetails = document.getElementById('bank_transfer_details');
            
            function togglePaymentDetails() {
                if (paymentMethod.value === 'credit_card' || paymentMethod.value === 'mada') {
                    creditCardDetails.classList.remove('hidden');
                    bankTransferDetails.classList.add('hidden');
                } else if (paymentMethod.value === 'bank_transfer') {
                    creditCardDetails.classList.add('hidden');
                    bankTransferDetails.classList.remove('hidden');
                }
            }
            
            togglePaymentDetails();
            paymentMethod.addEventListener('change', togglePaymentDetails);
        });
    </script>
</x-app-layout>
