<x-app-layout>
    <div class="py-12 bg-gradient-to-b from-blue-50 to-white" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg border border-blue-100">
                @if(session('success'))
                    <div class="bg-green-100 border-r-4 border-green-500 text-green-800 p-4 rounded-lg mb-6 mx-6 mt-6 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif
                
                <div class="px-8 py-6 bg-blue-600 dark:bg-blue-800 flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-white">تفاصيل طلب المشاركة</h1>
                        <p class="text-blue-100 mt-2">متابعة حالة طلب المشاركة ومعلوماته الكاملة</p>
                    </div>
                    <a href="{{ route('participation-requests.index') }}" class="px-4 py-2 bg-white text-blue-700 rounded-md hover:bg-blue-50 transition-colors duration-150 flex items-center shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 -mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        العودة لطلبات المشاركة
                    </a>
                </div>

                <div class="p-6">
                    <div class="flex flex-col md:flex-row gap-6 mb-8">
                        <!-- بطاقة تفاصيل الطلب -->
                        <div class="w-full md:w-2/3 bg-gray-50 dark:bg-gray-700 rounded-lg overflow-hidden shadow-sm border border-gray-200 dark:border-gray-700">
                            <div class="bg-gray-100 dark:bg-gray-600 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <div class="flex justify-between items-center">
                                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">معلومات الطلب</h2>
                                    <div class="flex items-center">
                                        <div class="ml-2 text-sm">الحالة:</div>
                                        @if($participationRequest->status === 'pending')
                                            <span class="inline-flex px-3 py-1 text-sm rounded-full font-medium bg-yellow-100 text-yellow-800">معلق</span>
                                        @elseif($participationRequest->status === 'approved')
                                            <span class="inline-flex px-3 py-1 text-sm rounded-full font-medium bg-green-100 text-green-800">مقبول</span>
                                        @elseif($participationRequest->status === 'rejected')
                                            <span class="inline-flex px-3 py-1 text-sm rounded-full font-medium bg-red-100 text-red-800">مرفوض</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">رقم الطلب</div>
                                        <div class="font-semibold text-gray-800 dark:text-white text-lg mt-1">#{{ $participationRequest->id }}</div>
                                    </div>
                                    
                                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">تاريخ الطلب</div>
                                        <div class="font-semibold text-gray-800 dark:text-white text-lg mt-1">{{ $participationRequest->created_at->format('Y-m-d') }}
                                            <span class="text-sm text-gray-500">{{ $participationRequest->created_at->format('H:i') }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            @if(Auth::user()->isOrganization())
                                                المتطوع
                                            @else
                                                المنظمة
                                            @endif
                                        </div>
                                        <div class="font-semibold text-gray-800 dark:text-white flex items-center mt-1">
                                            <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold ml-2">
                                                @if(Auth::user()->isOrganization())
                                                    {{ substr($participationRequest->user->name, 0, 1) }}
                                                @else
                                                    {{ substr($participationRequest->campaign->creator->name, 0, 1) }}
                                                @endif
                                            </div>
                                            @if(Auth::user()->isOrganization())
                                                {{ $participationRequest->user->name }}
                                            @else
                                                {{ $participationRequest->campaign->creator->name }}
                                            @endif
                                        </div>
                                    </div>
                                    
                                    @if($participationRequest->status === 'approved' || $participationRequest->status === 'rejected')
                                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            @if($participationRequest->status === 'approved')
                                                تاريخ الموافقة
                                            @else
                                                تاريخ الرفض
                                            @endif
                                        </div>
                                        <div class="font-semibold text-gray-800 dark:text-white text-lg mt-1">
                                            {{ $participationRequest->updated_at->format('Y-m-d') }}
                                            <span class="text-sm text-gray-500">{{ $participationRequest->updated_at->format('H:i') }}</span>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                
                                @if($participationRequest->message)
                                    <div class="mt-6 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
                                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">رسالة الطلب</div>
                                        <div class="text-gray-800 dark:text-white bg-gray-50 dark:bg-gray-700 p-4 rounded-lg border border-gray-200 dark:border-gray-600">
                                            {{ $participationRequest->message }}
                                        </div>
                                    </div>
                                @endif
                                
                                @if($participationRequest->response_message && ($participationRequest->status === 'approved' || $participationRequest->status === 'rejected'))
                                    <div class="mt-6 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 {{ $participationRequest->status === 'approved' ? 'border-r-4 border-green-500' : 'border-r-4 border-red-500' }}">
                                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                            @if($participationRequest->status === 'approved')
                                                رسالة الموافقة
                                            @else
                                                سبب الرفض
                                            @endif
                                        </div>
                                        <div class="text-gray-800 dark:text-white bg-gray-50 dark:bg-gray-700 p-4 rounded-lg border border-gray-200 dark:border-gray-600">
                                            {{ $participationRequest->response_message }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- بطاقة معلومات الحملة -->
                        <div class="w-full md:w-1/3">
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg overflow-hidden shadow-sm border border-gray-200 dark:border-gray-700">
                                <div class="bg-gray-100 dark:bg-gray-600 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">معلومات الحملة</h2>
                                </div>
                                <div class="p-6">
                                    <div class="flex-col items-center">
                                        @if($participationRequest->campaign->image)
                                            <img src="{{ asset('storage/' . $participationRequest->campaign->image) }}" alt="{{ $participationRequest->campaign->title }}" class="w-full h-48 object-cover rounded-lg">
                                        @else
                                            <div class="w-full h-48 bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="mt-4">
                                            <h3 class="font-bold text-gray-800 dark:text-white text-xl">{{ $participationRequest->campaign->title }}</h3>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                                <span class="font-semibold">بواسطة:</span> {{ $participationRequest->campaign->creator->name }}
                                            </p>
                                            <div class="mt-4 flex flex-wrap gap-2">
                                                @if($participationRequest->campaign->type === 'volunteer')
                                                    <span class="px-3 py-1 text-sm rounded-full font-medium bg-purple-100 text-purple-800">حملة تطوعية</span>
                                                @else
                                                    <span class="px-3 py-1 text-sm rounded-full font-medium bg-blue-100 text-blue-800">حملة مساعدة</span>
                                                @endif
                                                
                                                @if($participationRequest->campaign->target_amount)
                                                    <span class="px-3 py-1 text-sm rounded-full font-medium bg-green-100 text-green-800">
                                                        {{ number_format($participationRequest->campaign->current_amount) }} / {{ number_format($participationRequest->campaign->target_amount) }} ريال
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="mt-6">
                                                <a href="{{ route('campaigns.show', $participationRequest->campaign) }}" class="block w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white text-center font-medium rounded-lg transition-colors duration-300 shadow-sm">
                                                    عرض الحملة
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @if(Auth::user()->isOrganization() && $participationRequest->status === 'pending')
                                <div class="mt-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                                    <div class="bg-gray-100 dark:bg-gray-600 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">اتخاذ إجراء</h2>
                                    </div>
                                    <div class="p-6">
                                        <div class="space-y-6">
                                            <form action="{{ route('participation-requests.approve', $participationRequest) }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <x-input-label for="approve_message" value="رسالة الموافقة (اختياري)" />
                                                    <textarea id="approve_message" name="response_message" rows="3" placeholder="اكتب رسالة للمتطوع عن تفاصيل القبول..." class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                                                </div>
                                                <button type="submit" class="w-full py-2 px-4 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-300 shadow-sm flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    قبول الطلب
                                                </button>
                                            </form>
                                            
                                            <div class="relative">
                                                <div class="absolute inset-0 flex items-center">
                                                    <div class="w-full border-t border-gray-300 dark:border-gray-700"></div>
                                                </div>
                                                <div class="relative flex justify-center">
                                                    <span class="px-2 bg-white dark:bg-gray-800 text-sm text-gray-500 dark:text-gray-400">أو</span>
                                                </div>
                                            </div>
                                            
                                            <form action="{{ route('participation-requests.reject', $participationRequest) }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <x-input-label for="reject_message" value="سبب الرفض (اختياري)" />
                                                    <textarea id="reject_message" name="response_message" rows="3" placeholder="اكتب سبب رفض طلب المتطوع..." class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                                                </div>
                                                <button type="submit" class="w-full py-2 px-4 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-300 shadow-sm flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                    رفض الطلب
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
