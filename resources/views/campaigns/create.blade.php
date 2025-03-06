<x-app-layout>
    <div class="py-12" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">إنشاء حملة جديدة</h1>
                    <a href="{{ route('campaigns.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                        العودة للحملات &laquo;
                    </a>
                </div>

                <form action="{{ route('campaigns.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="title" value="عنوان الحملة" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" value="{{ old('title') }}" required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="type" value="نوع الحملة" />
                            <select id="type" name="type" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                @if(Auth::user()->isTeam())
                                    <option value="volunteer" {{ old('type') == 'volunteer' ? 'selected' : '' }}>حملة تطوع</option>
                                @endif
                                @if(Auth::user()->isOrganization())
                                    <option value="help" {{ old('type') == 'help' ? 'selected' : '' }}>حملة مساعدة</option>
                                @endif
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="description" value="وصف الحملة" />
                            <textarea id="description" name="description" rows="5" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="start_date" value="تاريخ البدء" />
                            <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" value="{{ old('start_date', now()->format('Y-m-d')) }}" required />
                            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="end_date" value="تاريخ الانتهاء (اختياري)" />
                            <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" value="{{ old('end_date') }}" />
                            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="target_amount" value="المبلغ المستهدف (اختياري)" />
                            <x-text-input id="target_amount" name="target_amount" type="number" step="0.01" min="0" class="mt-1 block w-full" value="{{ old('target_amount') }}" />
                            <x-input-error :messages="$errors->get('target_amount')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="location" value="الموقع (اختياري)" />
                            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" value="{{ old('location') }}" />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="image" value="صورة الحملة (اختياري)" />
                            <input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" />
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">يفضل أن تكون الصورة بحجم 1200×600 بكسل أو بنسبة 2:1.</p>
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-primary-button>
                            إنشاء الحملة
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
