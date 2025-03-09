@extends('admin.layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">لوحة التحكم</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">مرحبًا بك في لوحة تحكم منصة التطوع</p>
    </div>

    <!-- بطاقات الإحصائيات -->
    <div class="grid grid-cols-1 gap-5 mt-6 sm:grid-cols-2 lg:grid-cols-4">
        <!-- إجمالي المستخدمين -->
        <div class="p-5 bg-white rounded-lg shadow dark:bg-gray-800">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['users_count'] }}</div>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">إجمالي المستخدمين</div>
                </div>
                <div class="p-3 text-blue-500 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- إجمالي الحملات -->
        <div class="p-5 bg-white rounded-lg shadow dark:bg-gray-800">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['campaigns_count'] }}</div>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">إجمالي الحملات</div>
                </div>
                <div class="p-3 text-green-500 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- إجمالي التبرعات -->
        <div class="p-5 bg-white rounded-lg shadow dark:bg-gray-800">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['donations_sum'] ?? 0, 2) }}</div>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">إجمالي التبرعات</div>
                </div>
                <div class="p-3 text-yellow-500 bg-yellow-100 rounded-full dark:bg-yellow-900 dark:text-yellow-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- إجمالي طلبات المشاركة -->
        <div class="p-5 bg-white rounded-lg shadow dark:bg-gray-800">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['participation_requests_count'] }}</div>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">طلبات المشاركة</div>
                </div>
                <div class="p-3 text-purple-500 bg-purple-100 rounded-full dark:bg-purple-900 dark:text-purple-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-5 mt-8 lg:grid-cols-2">
        <!-- آخر المستخدمين -->
        <div class="p-5 bg-white rounded-lg shadow dark:bg-gray-800">
        <h2 class="text-lg font-medium text-gray-900 dark:text-white">آخر المستخدمين المسجلين</h2>
            <div class="mt-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">الاسم</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">البريد الإلكتروني</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">النوع</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">تاريخ التسجيل</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @forelse ($latestUsers as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($user->type == 'regular') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                                            @elseif($user->type == 'team') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                            @else bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300 @endif">
                                            {{ $user->type }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $user->created_at->format('Y-m-d') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 text-right">
                    <a href="{{ route('admin.users.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">
                        عرض جميع المستخدمين &rarr;
                    </a>
                </div>
            </div>
        </div>

        <!-- آخر الحملات -->
        <div class="p-5 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white">آخر الحملات المضافة</h2>
            <div class="mt-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">العنوان</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">المنشئ</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">الحالة</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">تاريخ الإنشاء</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @foreach ($latestCampaigns as $campaign)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $campaign->title }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $campaign->creator->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($campaign->status == 'active') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                            @elseif($campaign->status == 'draft') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                                            @elseif($campaign->status == 'completed') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                                            @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300 @endif">
                                            {{ $campaign->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $campaign->created_at->format('Y-m-d') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 text-right">
                    <a href="{{ route('admin.campaigns.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">
                        عرض جميع الحملات &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection