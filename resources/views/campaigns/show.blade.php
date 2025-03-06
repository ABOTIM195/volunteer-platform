<x-app-layout>
    <div class="py-12" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-6">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="mb-6">
                    <a href="{{ route('campaigns.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                        &laquo; العودة للحملات
                    </a>
                </div>

                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Campaign Image -->
                    <div class="md:w-1/3">
                        @if($campaign->image)
                            <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}" class="w-full rounded-lg shadow-md">
                        @else
                            <div class="w-full h-64 bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center">
                                <span class="text-gray-400 dark:text-gray-500">لا توجد صورة</span>
                            </div>
                        @endif

                        <!-- Campaign Creator Info -->
                        <div class="mt-6 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">معلومات المنظم</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-1">{{ $campaign->creator->name }}</p>
                            <p class="text-gray-600 dark:text-gray-300 mb-1">
                                {{ $campaign->creator->type == 'team' ? 'فريق تطوعي' : ($campaign->creator->type == 'organization' ? 'منظمة' : 'مستخدم عادي') }}
                            </p>
                            @if($campaign->creator->description)
                                <p class="text-gray-600 dark:text-gray-300 mt-2">{{ $campaign->creator->description }}</p>
                            @endif
                        </div>

                        <!-- Actions -->
                        <div class="mt-6 space-y-3">
                            @auth
                                @if(Auth::id() !== $campaign->creator_id)
                                    <!-- Donation Button -->
                                    <a href="{{ route('donations.create', $campaign) }}" class="block w-full text-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                        تبرع الآن
                                    </a>

                                    <!-- Like/Unlike Button -->
                                    @if($userLiked)
                                        <form action="{{ route('likes.destroy', $campaign) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="block w-full px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                                إلغاء الإعجاب ({{ $campaign->likes()->count() }})
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('likes.store', $campaign) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="block w-full px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                                أعجبني ({{ $campaign->likes()->count() }})
                                            </button>
                                        </form>
                                    @endif

                                    <!-- Participation Request Button (for help campaigns only) -->
                                    @if($campaign->isHelpCampaign() && Auth::user()->isRegular())
                                        @if($userRequested)
                                            <button disabled class="block w-full px-4 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest">
                                                تم تقديم طلب المشاركة
                                            </button>
                                        @else
                                            <form action="{{ route('participation-requests.store', $campaign) }}" method="POST">
                                                @csrf
                                                <div class="mb-2">
                                                    <textarea name="message" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="اكتب رسالة للمنظمة (اختياري)" rows="2"></textarea>
                                                </div>
                                                <button type="submit" class="block w-full px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                                    طلب المشاركة
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                @else
                                    <!-- Campaign management if user is the creator -->
                                    <a href="{{ route('campaigns.edit', $campaign) }}" class="block w-full text-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                        تعديل الحملة
                                    </a>
                                    <form action="{{ route('campaigns.destroy', $campaign) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من رغبتك في حذف هذه الحملة؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="block w-full px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                            حذف الحملة
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    تسجيل الدخول للتبرع أو المشاركة
                                </a>
                            @endauth
                        </div>
                    </div>

                    <!-- Campaign Details -->
                    <div class="md:w-2/3">
                        <div class="flex justify-between items-start">
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $campaign->title }}</h1>
                            <span class="px-3 py-1 text-sm rounded {{ $campaign->type == 'volunteer' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $campaign->type == 'volunteer' ? 'حملة تطوع' : 'حملة مساعدة' }}
                            </span>
                        </div>

                        <div class="mt-6 text-gray-600 dark:text-gray-300 space-y-4">
                            <p>{{ $campaign->description }}</p>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-4 text-sm">
                            <div class="bg-gray-100 dark:bg-gray-700 p-3 rounded-lg">
                                <span class="block text-gray-500 dark:text-gray-400">تاريخ البدء</span>
                                <span class="block text-gray-800 dark:text-white font-medium">{{ $campaign->start_date->format('Y-m-d') }}</span>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-700 p-3 rounded-lg">
                                <span class="block text-gray-500 dark:text-gray-400">تاريخ الانتهاء</span>
                                <span class="block text-gray-800 dark:text-white font-medium">
                                    {{ $campaign->end_date ? $campaign->end_date->format('Y-m-d') : 'غير محدد' }}
                                </span>
                            </div>
                        </div>

                        @if($campaign->target_amount)
                            <div class="mt-6 bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">هدف التبرعات</h3>
                                <div class="flex justify-between mb-1">
                                    <span>{{ number_format($campaign->current_amount, 2) }} من {{ number_format($campaign->target_amount, 2) }} ريال</span>
                                    <span>{{ round(($campaign->current_amount / $campaign->target_amount) * 100) }}%</span>
                                </div>
                                <div class="w-full bg-gray-300 dark:bg-gray-600 rounded-full h-4">
                                    <div class="bg-blue-600 h-4 rounded-full" style="width: {{ min(($campaign->current_amount / $campaign->target_amount) * 100, 100) }}%"></div>
                                </div>
                            </div>

                            <!-- Recent Donations -->
                            @if($campaign->donations->count() > 0)
                                <div class="mt-6">
                                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">آخر التبرعات</h3>
                                    <div class="space-y-3">
                                        @foreach($campaign->donations->take(5) as $donation)
                                            <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                                                <div class="flex justify-between">
                                                    <span class="font-medium">{{ $donation->user->name }}</span>
                                                    <span class="text-blue-600 dark:text-blue-400">{{ number_format($donation->amount, 2) }} ريال</span>
                                                </div>
                                                @if($donation->message)
                                                    <p class="text-gray-600 dark:text-gray-300 text-sm mt-1">{{ $donation->message }}</p>
                                                @endif
                                                <div class="text-gray-400 text-xs mt-1">{{ $donation->created_at->diffForHumans() }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endif

                        <!-- Comments -->
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">التعليقات ({{ $campaign->comments->count() }})</h3>
                            
                            @auth
                                <form action="{{ route('comments.store', $campaign) }}" method="POST" class="mb-6">
                                    @csrf
                                    <div class="mb-2">
                                        <textarea name="content" rows="3" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="اكتب تعليقاً..."></textarea>
                                        @error('content')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <button type="submit" class="px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                        إضافة تعليق
                                    </button>
                                </form>
                            @else
                                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg mb-6 text-center">
                                    <p>يرجى <a href="{{ route('login') }}" class="text-blue-600 dark:text-blue-400 hover:underline">تسجيل الدخول</a> لإضافة تعليق</p>
                                </div>
                            @endauth

                            @if($campaign->comments->count() > 0)
                                <div class="space-y-4">
                                    @foreach($campaign->comments as $comment)
                                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                            <div class="flex justify-between">
                                                <div class="font-medium text-gray-800 dark:text-white">{{ $comment->user->name }}</div>
                                                <div class="text-gray-400 text-sm">{{ $comment->created_at->diffForHumans() }}</div>
                                            </div>
                                            <div class="mt-2 text-gray-600 dark:text-gray-300">{{ $comment->content }}</div>
                                            
                                            @auth
                                                @if(Auth::id() === $comment->user_id || Auth::id() === $campaign->creator_id)
                                                    <div class="mt-2 text-right">
                                                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm" onclick="return confirm('هل أنت متأكد من رغبتك في حذف هذا التعليق؟')">
                                                                حذف
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-4 text-gray-500 dark:text-gray-400">
                                    لا توجد تعليقات حتى الآن. كن أول من يعلق!
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
