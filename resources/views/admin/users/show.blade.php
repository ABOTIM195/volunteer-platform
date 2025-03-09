@extends('admin.layouts.app')

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">تفاصيل المستخدم</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">عرض وتعديل بيانات المستخدم</p>
            </div>
            <div>
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-600">
                    العودة للقائمة
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- معلومات المستخدم -->
        <div class="lg:col-span-1">
            <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 mb-4 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-700">
                        <img src="{{ $user->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&color=7F9CF5&background=EBF4FF' }}" alt="{{ $user->name }}" class="object-cover w-full h-full">
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $user->name }}</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                    
                    <div class="w-full mt-6">
                        <div class="flex justify-between py-2 border-b border-gray-200 dark:border-gray-700">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">نوع المستخدم</span>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->type }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-gray-200 dark:border-gray-700">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">مدير</span>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->is_admin ? 'نعم' : 'لا' }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-gray-200 dark:border-gray-700">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">تاريخ التسجيل</span>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->created_at->format('Y-m-d') }}</span>
                        </div>
                        <div class="flex justify-between py-2">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">آخر تحديث</span>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->updated_at->format('Y-m-d') }}</span>
                        </div>
                    </div>
                    
                    @if(auth()->id() !== $user->id)
                        <div class="w-full mt-6">
                            <form action="{{ route('admin.users.delete', $user) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا المستخدم؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:bg-red-500 dark:hover:bg-red-600">
                                    حذف المستخدم
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- نموذج تعديل المستخدم -->
        <div class="lg:col-span-2">
            <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
                <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">تعديل بيانات المستخدم</h3>
                
                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">الاسم</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">البريد الإلكتروني</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">نوع المستخدم</label>
                            <select name="type" id="type" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="regular" {{ old('type', $user->type) == 'regular' ? 'selected' : '' }}>عادي</option>
                                <option value="team" {{ old('type', $user->type) == 'team' ? 'selected' : '' }}>فريق</option>
                                <option value="organization" {{ old('type', $user->type) == 'organization' ? 'selected' : '' }}>منظمة</option>
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="is_admin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">صلاحيات المدير</label>
                            <select name="is_admin" id="is_admin" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="0" {{ old('is_admin', $user->is_admin) == 0 ? 'selected' : '' }}>لا</option>
                                <option value="1" {{ old('is_admin', $user->is_admin) == 1 ? 'selected' : '' }}>نعم</option>
                            </select>
                            @error('is_admin')
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
            
            <!-- إحصائيات المستخدم -->
            <div class="p-6 mt-6 bg-white rounded-lg shadow dark:bg-gray-800">
                <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">إحصائيات المستخدم</h3>
                
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="p-4 bg-gray-50 rounded-lg dark:bg-gray-700">
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user->campaigns->count() }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">الحملات المنشأة</div>
                    </div>
                    
                    <div class="p-4 bg-gray-50 rounded-lg dark:bg-gray-700">
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user->comments->count() }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">التعليقات</div>
                    </div>
                    
                    <div class="p-4 bg-gray-50 rounded-lg dark:bg-gray-700">
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user->participationRequests->count() }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">طلبات المشاركة</div>
                    </div>
                    
                    <div class="p-4 bg-gray-50 rounded-lg dark:bg-gray-700">
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user->donations->sum('amount') }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">إجمالي التبرعات</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection