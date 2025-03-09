@extends('admin.layouts.app')

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">تفاصيل الحملة</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">عرض وتعديل بيانات الحملة</p>
            </div>
            <div>
                <a href="{{ route('admin.campaigns.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-600">
                    العودة للقائمة
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- معلومات الحملة -->
        <div class="lg:col-span-1">
            <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
                <div class="mb-4 overflow-hidden rounded-lg">
                    <img src="{{ $campaign->image_path ? Storage::url($campaign->image_path) : asset('images/default-campaign.jpg') }}" alt="{{ $campaign->title }}" class="object-cover w-full h-48">
                </div>
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $campaign->title }}</h2>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ Str::limit($campaign->description, 150) }}</p>
                
                <div class="w-full mt-6">
                    <div class="flex justify-between py-2 border-b border-gray-200 dark:border-gray-700">
                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">المنشئ</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $campaign->creator->name }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-200 dark:border-gray-700">
                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">الحالة</span>
                        <span class="px-2 text-xs font-semibold leading-5 rounded-full 
                            @if($campaign->status == 'active') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                            @elseif($campaign->status == 'draft') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                            @elseif($campaign->status == 'completed') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                            @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300 @endif">
                            {{ $campaign->status }}
                        </span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-200 dark:border-gray-700">
                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">مميزة</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $campaign->featured ? 'نعم' : 'لا' }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-200 dark:border-gray-700">
                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">الهدف المالي</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ number_format($campaign->funding_goal, 2) }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-200 dark:border-gray-700">
                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">المبلغ المجمع</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ number_format($campaign->donations_sum, 2) }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-200 dark:border-gray-700">
                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">تاريخ البدء</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $campaign->start_date ? $campaign->start_date->format('Y-m-d') : 'غير محدد' }}</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">تاريخ الانتهاء</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $campaign->end_date ? $campaign->end_date->format('Y-m-d') : 'غير محدد' }}</span>
                    </div>
                </div>
                
                <div class="w-full mt-6">
                    <form action="{{ route('admin.campaigns.delete', $campaign) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه الحملة؟');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:bg-red-500 dark:hover:bg-red-600">
                            حذف الحملة
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- نموذج تعديل الحملة -->
        <div class="lg:col-span-2">
            <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
                <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">تعديل بيانات الحملة</h3>
                
                <form action="{{ route('admin.campaigns.update', $campaign) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">عنوان الحملة</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $campaign->title) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="sm:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">وصف الحملة</label>
                            <textarea name="description" id="description" rows="4" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description', $campaign->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">الحالة</label>
                            <select name="status" id="status" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="draft" {{ old('status', $campaign->status) == 'draft' ? 'selected' : '' }}>مسودة</option>
                                <option value="active" {{ old('status', $campaign->status) == 'active' ? 'selected' : '' }}>نشطة</option>
                                <option value="completed" {{ old('status', $campaign->status) == 'completed' ? 'selected' : '' }}>مكتملة</option>
                                <option value="cancelled" {{ old('status', $campaign->status) == 'cancelled' ? 'selected' : '' }}>ملغاة</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="featured" class="block text-sm font-medium text-gray-700 dark:text-gray-300">مميزة</label>
                            <select name="featured" id="featured" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="0" {{ old('featured', $campaign->featured) == 0 ? 'selected' : '' }}>لا</option>
                                <option value="1" {{ old('featured', $campaign->featured) == 1 ? 'selected' : '' }}>نعم</option>
                            </select>
                            @error('featured')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="funding_goal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">الهدف المالي</label>
                            <input type="number" name="funding_goal" id="funding_goal" value="{{ old('funding_goal', $campaign->funding_goal) }}" step="0.01" min="0" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('funding_goal')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">الموقع</label>
                            <input type="text" name="location" id="location" value="{{ old('location', $campaign->location) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('location')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">تاريخ البدء</label>
                            <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $campaign->start_date ? $campaign->start_date->format('Y-m-d') : '') }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('start_date')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">تاريخ الانتهاء</label>
                            <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $campaign->end_date ? $campaign->end_date->format('Y-m-d') : '') }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('end_date')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="sm:col-span-2">
                            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">صورة الحملة</label>
                            <input type="file" name="image" id="image" class="block w-full mt-1 text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @if($campaign->image_path)
                                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">الصورة الحالية: {{ basename($campaign->image_path) }}</p>
                            @endif
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
            
            <!-- طلبات المشاركة -->
            <div class="p-6 mt-6 bg-white rounded-lg shadow dark:bg-gray-800">
                <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">طلبات المشاركة</h3>
                
                @if($campaign->participationRequests->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">المستخدم</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">الحالة</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">تاريخ الطلب</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @foreach($campaign->participationRequests as $request)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $request->user->name }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $request->user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($request->status == 'approved') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                                @elseif($request->status == 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                                                @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300 @endif">
                                                {{ $request->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $request->created_at->format('Y-m-d') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2 rtl:space-x-reverse">
                                                @if($request->status == 'pending')
                                                    <form action="{{ route('admin.participation-requests.approve', $request) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300">قبول</button>
                                                    </form>
                                                    <form action="{{ route('admin.participation-requests.reject', $request) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">رفض</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 dark:text-gray-400">لا توجد طلبات مشاركة لهذه الحملة.</p>
                @endif
            </div>
            
            <!-- التعليقات -->
            <div class="p-6 mt-6 bg-white rounded-lg shadow dark:bg-gray-800">
                <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">التعليقات</h3>
                
                @if($campaign->comments->count() > 0)
                    <div class="space-y-4">
                        @foreach($campaign->comments as $comment)
                            <div class="p-4 bg-gray-50 rounded-lg dark:bg-gray-700">
                                <div class="flex justify-between">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $comment->user->name }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $comment->created_at->format('Y-m-d H:i') }}</div>
                                </div>
                                <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ $comment->content }}</div>
                                <div class="mt-2 text-right">
                                    <form action="{{ route('admin.comments.delete', $comment) }}" method="POST" class="inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا التعليق؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">حذف</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 dark:text-gray-400">لا توجد تعليقات على هذه الحملة.</p>
                @endif
            </div>
        </div>
    </div>
@endsection