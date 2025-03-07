<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <div class="flex flex-col md:flex-row gap-8">
                        <!-- صورة المستخدم والمعلومات الأساسية -->
                        <div class="md:w-1/3 flex flex-col items-center">
                            <div class="mb-6 text-center">
                                @if(auth()->user()->avatar)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}" class="w-32 h-32 rounded-full object-cover border-4 border-indigo-500 shadow-lg mx-auto">
                                @else
                                    <div class="w-32 h-32 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center text-4xl font-bold text-indigo-500 dark:text-indigo-300 border-4 border-indigo-500 shadow-lg mx-auto">
                                        {{ substr(auth()->user()->name, 0, 1) }}
                                    </div>
                                @endif
                                <h3 class="mt-4 text-xl font-bold text-gray-800 dark:text-white">{{ auth()->user()->name }}</h3>
                                <p class="text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</p>
                                <p class="mt-2 px-4 py-1 bg-indigo-100 dark:bg-indigo-900 text-indigo-700 dark:text-indigo-300 rounded-full text-sm inline-block">
                                    {{ auth()->user()->type === 'individual' ? 'متطوع فردي' : 'مؤسسة' }}
                                </p>
                            </div>
                            
                            <div class="w-full bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-6">
                                <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-3">إحصائيات سريعة</h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="text-center p-3 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                                        <p class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">{{ auth()->user()->campaigns()->count() }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">الحملات</p>
                                    </div>
                                    <div class="text-center p-3 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                                        <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ auth()->user()->participationRequests()->count() }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">المشاركات</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- أقسام تعديل الملف الشخصي -->
                        <div class="md:w-2/3">
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                            
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                                @include('profile.partials.update-password-form')
                            </div>
                            
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
