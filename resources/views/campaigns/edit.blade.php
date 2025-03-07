<x-app-layout>
    <div class="py-12" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">تعديل الحملة</h1>
                    <a href="{{ route('campaigns.show', $campaign) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                        العودة للحملة &laquo;
                    </a>
                </div>

                <form action="{{ route('campaigns.update', $campaign) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="title" value="عنوان الحملة" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" value="{{ old('title', $campaign->title) }}" required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="type" value="نوع الحملة" />
                            <select id="type" name="type" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
                                <option value="volunteer" {{ $campaign->type == 'volunteer' ? 'selected' : '' }}>حملة تطوع</option>
                                <option value="help" {{ $campaign->type == 'help' ? 'selected' : '' }}>حملة مساعدة</option>
                            </select>
                            <input type="hidden" name="type" value="{{ $campaign->type }}">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">لا يمكن تغيير نوع الحملة بعد إنشائها.</p>
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="description" value="وصف الحملة" />
                            <textarea id="description" name="description" rows="5" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ old('description', $campaign->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="start_date" value="تاريخ البدء" />
                            <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" value="{{ old('start_date', $campaign->start_date->format('Y-m-d')) }}" required />
                            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="end_date" value="تاريخ الانتهاء (اختياري)" />
                            <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" value="{{ old('end_date', $campaign->end_date ? $campaign->end_date->format('Y-m-d') : '') }}" />
                            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="target_amount" value="المبلغ المستهدف (اختياري)" />
                            <x-text-input id="target_amount" name="target_amount" type="number" step="0.01" min="0" class="mt-1 block w-full" value="{{ old('target_amount', $campaign->target_amount) }}" />
                            <x-input-error :messages="$errors->get('target_amount')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="location" value="الموقع (اختياري)" />
                            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" value="{{ old('location', $campaign->location) }}" />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <!-- قسم الصورة -->
                        <div class="mb-4">
                            <label for="image" class="block text-gray-700 dark:text-gray-300 mb-2">صورة الحملة</label>
                            
                            @if($campaign->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}" class="w-32 h-32 object-cover rounded-md">
                                </div>
                                <div class="mb-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="remove_image" class="rounded border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800">
                                        <span class="mr-2 text-sm text-gray-600 dark:text-gray-400">إزالة الصورة الحالية</span>
                                    </label>
                                </div>
                            @endif
                            
                            <input type="file" name="image" id="image" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">اختياري. الصيغ المدعومة: JPG, PNG, GIF. الحد الأقصى: 2MB</p>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-primary-button>
                            حفظ التغييرات
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
