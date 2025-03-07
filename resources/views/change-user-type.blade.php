<x-app-layout>
    <div class="py-12" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">تغيير نوع المستخدم</h1>
                
                @if(Auth::check())
                    <div class="bg-gray-100 border border-gray-300 text-gray-700 px-4 py-3 rounded mb-4">
                        <p><strong>الاسم:</strong> {{ Auth::user()->name }}</p>
                        <p><strong>البريد الإلكتروني:</strong> {{ Auth::user()->email }}</p>
                        <p><strong>نوع الحساب الحالي:</strong> 
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
                    </div>

                    <form action="{{ route('change-user-type') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="user_type" value="اختر نوع الحساب الجديد" />
                            <select id="user_type" name="user_type" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="regular" {{ Auth::user()->isRegular() ? 'selected' : '' }}>مستخدم عادي</option>
                                <option value="team" {{ Auth::user()->isTeam() ? 'selected' : '' }}>فريق تطوعي</option>
                                <option value="organization" {{ Auth::user()->isOrganization() ? 'selected' : '' }}>منظمة</option>
                            </select>
                        </div>
                        
                        <div>
                            <x-primary-button>
                                تغيير نوع الحساب
                            </x-primary-button>
                        </div>
                    </form>

                    <div class="mt-6">
                        <a href="{{ route('user-check') }}" class="text-blue-600 hover:text-blue-900">العودة إلى صفحة التحقق من المستخدم</a>
                    </div>
                @else
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <p><strong>الحالة:</strong> غير مسجل الدخول</p>
                        <p>يجب عليك تسجيل الدخول للوصول إلى هذه الصفحة.</p>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">تسجيل الدخول</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
