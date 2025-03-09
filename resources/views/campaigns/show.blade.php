<x-app-layout>
    <div class="py-12" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <a href="{{ route('campaigns.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                            &larr; العودة إلى الحملات
                        </a>
                    </div>
                    
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="md:w-2/3">
                            <h1 class="text-3xl font-bold mb-4">{{ $campaign->title }}</h1>
                            
                            <div class="mb-6">
                                <span class="inline-flex items-center px-3 py-1 bg-gray-100 dark:bg-gray-700 rounded-full text-sm font-medium text-gray-800 dark:text-gray-200 mr-2">
                                    {{ $campaign->type === 'volunteer' ? 'حملة تطوعية' : 'حملة مساعدة' }}
                                </span>
                                <span class="text-gray-500 dark:text-gray-400">
                                    تم النشر {{ $campaign->created_at->diffForHumans() }}
                                </span>
                            </div>
                            
                            @if($campaign->image)
                                <!-- معلومات تصحيح - قم بإزالتها بعد حل المشكلة -->
                                @if(config('app.debug'))
                                <div class="bg-yellow-100 p-2 mb-2 rounded text-sm">
                                    <p>قيمة الصورة: {{ $campaign->image }}</p>
                                    <p>مسار الصورة: {{ $campaign->image_url }}</p>
                                </div>
                                @endif
                                
                                <!-- استخدام طرق مختلفة لعرض الصورة -->
                                <div class="mb-6">
                                    <!-- الطريقة 1: استخدام URL مباشر -->
                                    <img src="{{ url('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}" class="w-full h-auto rounded-lg mb-2">
                                </div>
                            @endif
                            
                            <div class="prose dark:prose-invert max-w-none mb-6">
                                {!! nl2br(e($campaign->description)) !!}
                            </div>
                            
                            <div class="mb-6">
                                <h2 class="text-xl font-semibold mb-2">تفاصيل الحملة</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-gray-600 dark:text-gray-400">تاريخ البدء:</p>
                                        <p>{{ \Carbon\Carbon::parse($campaign->start_date)->format('Y-m-d') }}</p>
                                    </div>
                                    @if($campaign->end_date)
                                    <div>
                                        <p class="text-gray-600 dark:text-gray-400">تاريخ الانتهاء:</p>
                                        <p>{{ \Carbon\Carbon::parse($campaign->end_date)->format('Y-m-d') }}</p>
                                    </div>
                                    @endif
                                    @if($campaign->type === 'help' && $campaign->target_amount)
                                    <div>
                                        <p class="text-gray-600 dark:text-gray-400">المبلغ المستهدف:</p>
                                        <p>{{ $campaign->target_amount }} ريال</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 dark:text-gray-400">المبلغ الحالي:</p>
                                        <p>{{ $campaign->current_amount }} ريال</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <h2 class="text-xl font-semibold mb-2">المنظم</h2>
                                <div class="flex items-center">
                                    <div class="mr-4">
                                        <p class="font-medium">{{ $campaign->creator->name }}</p>
                                        <p class="text-gray-600 dark:text-gray-400">{{ $campaign->creator->type }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            @auth
                                <div class="flex flex-wrap gap-2 mb-6">
                                    @if(Auth::id() === $campaign->creator_id)
                                        <a href="{{ route('campaigns.edit', $campaign) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                                            تعديل الحملة
                                        </a>
                                        <form action="{{ route('campaigns.destroy', $campaign) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه الحملة؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                                                حذف الحملة
                                            </button>
                                        </form>
                                    @else
                                        @if($campaign->type === 'volunteer' && !$userRequested)
                                            <form action="{{ route('participation-requests.store', $campaign) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                                                    طلب المشاركة
                                                </button>
                                            </form>
                                        @elseif($campaign->type === 'volunteer' && $userRequested)
                                            <span class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md">
                                                تم تقديم طلب المشاركة
                                            </span>
                                        @endif
                                        
                                        @if($campaign->type === 'help')
                                            <button type="button" onclick="document.getElementById('donationModal').classList.remove('hidden')" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                                                تبرع الآن
                                            </button>
                                        @endif
                                        
                                        <form action="{{ $userLiked ? route('likes.destroy', $campaign) : route('likes.store', $campaign) }}" method="POST">
                                            @csrf
                                            @if($userLiked)
                                                @method('DELETE')
                                            @endif
                                            <button type="submit" class="px-4 py-2 {{ $userLiked ? 'bg-red-100 text-red-800' : 'bg-gray-200 text-gray-800' }} rounded-md hover:bg-opacity-90 transition">
                                                {{ $userLiked ? 'إلغاء الإعجاب' : 'أعجبني' }} ({{ $campaign->likes()->count() }})
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endauth
                            
                            <!-- Comments Section -->
                            <div class="mt-8">
                                <h2 class="text-xl font-semibold mb-4">التعليقات ({{ $campaign->comments->count() }})</h2>
                                
                                @auth
                                    <form action="{{ route('comments.store', $campaign) }}" method="POST" class="mb-6">
                                        @csrf
                                        <div class="mb-4">
                                            <textarea name="content" rows="3" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="أضف تعليقك هنا..."></textarea>
                                        </div>
                                        <div class="flex justify-end">
                                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                                                إضافة تعليق
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <div class="mb-6 p-4 bg-gray-100 dark:bg-gray-700 rounded-md">
                                        <p class="text-center">
                                            <a href="{{ route('login') }}" class="text-blue-600 dark:text-blue-400 hover:underline">سجل دخول</a>
                                            لإضافة تعليق
                                        </p>
                                    </div>
                                @endauth
                                
                                <div class="space-y-4">
                                    @forelse($campaign->comments as $comment)
                                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                            <div class="flex justify-between mb-2">
                                                <div class="font-medium">{{ $comment->user->name }}</div>
                                                <div class="text-gray-500 dark:text-gray-400 text-sm">{{ $comment->created_at->diffForHumans() }}</div>
                                            </div>
                                            <p class="text-gray-800 dark:text-gray-200">{{ $comment->content }}</p>
                                            
                                            @if(Auth::check() && (Auth::id() === $comment->user_id || Auth::id() === $campaign->creator_id))
                                                <div class="mt-2 text-right">
                                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 dark:text-red-400 text-sm hover:underline">
                                                            حذف
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    @empty
                                        <p class="text-center text-gray-500 dark:text-gray-400">لا توجد تعليقات حتى الآن</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        
                        <div class="md:w-1/3">
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg sticky top-4">
                                @if($campaign->type === 'help' && $campaign->target_amount)
                                    <div class="mb-4">
                                        <h3 class="font-semibold mb-2">تقدم التبرعات</h3>
                                        <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-4 mb-2">
                                            @php
                                                $percentage = $campaign->target_amount > 0 
                                                    ? min(100, ($campaign->current_amount / $campaign->target_amount) * 100) 
                                                    : 0;
                                            @endphp
                                            <div class="bg-green-600 h-4 rounded-full" style="width: {{ $percentage }}%"></div>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span>{{ $campaign->current_amount }} ريال</span>
                                            <span>{{ $campaign->target_amount }} ريال</span>
                                        </div>
                                        <div class="text-center mt-2 text-sm text-gray-600 dark:text-gray-400">
                                            {{ number_format($percentage, 1) }}% من الهدف
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <h3 class="font-semibold mb-2">آخر التبرعات</h3>
                                        <div class="space-y-2">
                                            @forelse($campaign->donations->take(5) as $donation)
                                                <div class="flex justify-between items-center text-sm">
                                                    <span>{{ $donation->user->name }}</span>
                                                    <span>{{ $donation->amount }} ريال</span>
                                                </div>
                                            @empty
                                                <p class="text-center text-gray-500 dark:text-gray-400 text-sm">لا توجد تبرعات حتى الآن</p>
                                            @endforelse
                                        </div>
                                    </div>
                                @endif
                                
                                <div>
                                    <h3 class="font-semibold mb-2">مشاركة الحملة</h3>
                                    <div class="flex gap-2">
                                        <button onclick="navigator.clipboard.writeText(window.location.href); alert('تم نسخ الرابط');" class="flex-1 px-3 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition text-sm">
                                            نسخ الرابط
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Donation Modal -->
    @if(Auth::check() && $campaign->type === 'help')
    <div id="donationModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">تبرع للحملة</h2>
            <form action="{{ route('donations.store', $campaign) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="amount" class="block text-gray-700 dark:text-gray-300 mb-2">مبلغ التبرع (ريال)</label>
                    <input type="number" name="amount" id="amount" min="1" step="1" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="notes" class="block text-gray-700 dark:text-gray-300 mb-2">ملاحظات (اختياري)</label>
                    <textarea name="notes" id="notes" rows="3" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                </div>
                <div class="flex justify-between">
                    <button type="button" onclick="document.getElementById('donationModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">
                        إلغاء
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                        تبرع الآن
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
</x-app-layout>