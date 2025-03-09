<x-app-layout>
    <div class="py-12" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">إنشاء حملة جديدة</h1>
                    
                    <form method="POST" action="{{ route('campaigns.store') }}" enctype="multipart/form-data">
                        @csrf
                         
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('عنوان الحملة')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('وصف الحملة')" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        
                        <div class="mb-4">
                            <x-input-label for="type" :value="__('نوع الحملة')" />
                            <select id="type" name="type" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="volunteer">حملة تطوع</option>
                                <option value="help">حملة مساعدة</option>
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>
                        
                        <div class="mb-4">
                            <x-input-label for="start_date" :value="__('تاريخ البدء')" />
                            <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="old('start_date')" required />
                            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                        </div>
                        
                        <div class="mb-4">
                            <x-input-label for="end_date" :value="__('تاريخ الانتهاء (اختياري)')" />
                            <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" :value="old('end_date')" />
                            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                        </div>
                        
                        <div class="mb-4">
                            <x-input-label for="target_amount" :value="__('المبلغ المستهدف (للحملات المساعدة)')" />
                            <x-text-input id="target_amount" class="block mt-1 w-full" type="number" step="0.01" name="target_amount" :value="old('target_amount')" />
                            <x-input-error :messages="$errors->get('target_amount')" class="mt-2" />
                        </div>
                        
                        <div class="mb-4">
                            <x-input-label for="image" :value="__('صورة الحملة (اختياري)')" />
                            <input id="image" type="file" name="image" class="block mt-1 w-full" />
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
                        
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-3">
                                {{ __('إنشاء الحملة') }}
                            </x-primary-button>
                            <a href="{{ route('campaigns.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('إلغاء') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>