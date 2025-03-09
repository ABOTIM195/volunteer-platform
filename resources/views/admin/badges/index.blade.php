@extends('admin.layouts.app')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">إدارة الشارات</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">عرض وإدارة شارات المنصة</p>
        </div>
        <div>
            <a href="{{ route('admin.badges.create') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600">
                إضافة شارة جديدة
            </a>
        </div>
    </div>

    <!-- بحث -->
    <div class="p-5 mb-6 bg-white rounded-lg shadow dark:bg-gray-800">
        <form action="{{ route('admin.badges.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <label for="search" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">بحث</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="ابحث باسم الشارة" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            <div class="self-end">
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600">
                    بحث
                </button>
            </div>
        </form>
    </div>

    <!-- عرض الشارات -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        @foreach($badges as $badge)
            <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 mb-4 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-700">
                        <img src="{{ $badge->image_path ? Storage::url($badge->image_path) : asset('images/default-badge.png') }}" alt="{{ $badge->name }}" class="object-cover w-full h-full">
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ $badge->name }}</h3>
                    <p class="mt-1 text-sm text-center text-gray-500 dark:text-gray-400">{{ $badge->description }}</p>
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">النقاط المطلوبة: {{ $badge->points_required }}</p>
                    
                    <div class="flex mt-4 space-x-2 rtl:space-x-reverse">
                        <a href="{{ route('admin.badges.edit', $badge) }}" class="px-3 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-md hover:bg-blue-200 dark:bg-blue-900 dark:text-blue-300 dark:hover:bg-blue-800">
                            تعديل
                        </a>
                        <form action="{{ route('admin.badges.delete', $badge) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه الشارة؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-md hover:bg-red-200 dark:bg-red-900 dark:text-red-300 dark:hover:bg-red-800">
                                حذف
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- ترقيم الصفحات -->
    <div class="mt-6">
        {{ $badges->withQueryString()->links() }}
    </div>
@endsection