@extends('admin.layouts.app')

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">تعديل الشارة</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">تعديل بيانات الشارة</p>
            </div>
            <div>
                <a href="{{ route('admin.badges.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-600">
                    العودة للقائمة
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- معاينة الشارة -->
        <div class="lg:col-span-1">
            <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
                <div class="flex flex-col items-center">
                    <div class="w-32 h-32 mb-4 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-700">
                        <img src="{{ $badge->image_path ? Storage::url($badge->image_path) : asset('images/default-badge.png') }}" alt="{{ $badge->name }}" class="object-cover w-full h-full">
                    </div>
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">{{ $badge->name }}</h3>
                    <p class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">{{ $badge->description }}</p>
                    <p class="mt-3 text-sm text-gray-500 dark:text-gray-400">النقاط المطلوبة: {{ $badge->points_required }}</p>
                    
                    <div class="w-full mt-6">
                        <form action="{{ route('admin.badges.delete', $badge) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه الشارة؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:bg-red-500 dark:hover:bg-red-600">
                                حذف الشارة
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- نموذج التعديل -->
        <div class="lg:col-span-2">
            <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
                <form action="{{ route('admin.badges.update', $badge) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">اسم الشارة</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $badge->name) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="points_required" class="block text-sm font-medium text-gray-700 dark:text-gray-300">النقاط المطلوبة</label>
                            <input type="number" name="points_required" id="points_required" value="{{ old('points_required', $badge->points_required) }}" min="0" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            @error('points_required')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="sm:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">وصف الشارة</label>
                            <textarea name="description" id="description" rows="3" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description', $badge->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="sm:col-span-2">
                            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">صورة الشارة</label>
                            <input type="file" name="image" id="image" class="block w-full mt-1 text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">اترك هذا الحقل فارغًا للاحتفاظ بالصورة الحالية. يفضل أن تكون الصورة مربعة بأبعاد 200×200 بكسل.</p>
                            @error('image')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600">
                            حفظ التغييرات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection