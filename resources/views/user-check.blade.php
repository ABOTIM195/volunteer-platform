<x-app-layout>
    <div class="py-12" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">معلومات المستخدم الحالي</h1>
                
                @if(Auth::check())
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <p><strong>الحالة:</strong> مسجل الدخول</p>
                    </div>
                    
                    <div class="bg-gray-100 border border-gray-300 text-gray-700 px-4 py-3 rounded mb-4">
                        <p><strong>الاسم:</strong> {{ Auth::user()->name }}</p>
                        <p><strong>البريد الإلكتروني:</strong> {{ Auth::user()->email }}</p>
                        <p><strong>نوع الحساب:</strong> 
                            @if(Auth::user()->isRegular())
                                مستخدم عادي
                            @elseif(Auth::user()->isTeam())
                                فريق تطوعي
                            @elseif(Auth::user()->isOrganization())
                                منظمة
                            @else
                                غير معروف
                            @endif
                        </p>
                        <p><strong>معرف المستخدم:</strong> {{ Auth::id() }}</p>
                    </div>

                    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4">
                        <p><strong>يمكنه إنشاء حملات: </strong> 
                            @if(Auth::user()->isRegular())
                                <span class="text-red-600">لا</span> (فقط الفرق التطوعية والمنظمات يمكنها إنشاء حملات)
                                <form action="{{ route('change-user-type') }}" method="POST" class="mt-2">
                                    @csrf
                                    <input type="hidden" name="user_type" value="team">
                                    <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 text-sm">
                                        تغيير نوع الحساب إلى فريق تطوعي
                                    </button>
                                </form>
                            @else
                                <span class="text-green-600">نعم</span>
                            @endif
                        </p>
                    </div>

                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-6 mb-4">روابط مفيدة:</h2>
                    <div class="flex space-x-4 space-x-reverse">
                        <a href="{{ route('campaigns.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">الحملات</a>
                        @if(!Auth::user()->isRegular())
                            <a href="{{ route('campaigns.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">إنشاء حملة</a>
                        @endif
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">لوحة التحكم</a>
                        <a href="{{ route('show-change-user-type') }}" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">تغيير نوع الحساب</a>
                    </div>

                    @if(session('success'))
                        <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                @else
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <p><strong>الحالة:</strong> غير مسجل الدخول</p>
                        <p>يجب عليك تسجيل الدخول للوصول إلى هذه الصفحة.</p>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">تسجيل الدخول</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 mr-2">إنشاء حساب جديد</a>
                    </div>
                @endif

                <div class="mt-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">معلومات المسارات:</h2>
                    <div class="bg-gray-100 border border-gray-300 text-gray-700 px-4 py-3 rounded">
                        <p><strong>طريقة الوصول إلى صفحة إنشاء الحملات:</strong> <code>{{ route('campaigns.create') }}</code></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
