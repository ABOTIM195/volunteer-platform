@extends('admin.layouts.app')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">إحصائيات النظام</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">عرض إحصائيات عامة عن النظام</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- إحصائيات المستخدمين -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">المستخدمين</h2>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">إجمالي المستخدمين:</span>
                    <span class="font-medium">{{ $totalUsers }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">مستخدمين عاديين:</span>
                    <span class="font-medium">{{ $regularUsers }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">فرق تطوعية:</span>
                    <span class="font-medium">{{ $teamUsers }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">منظمات:</span>
                    <span class="font-medium">{{ $organizationUsers }}</span>
                </div>
            </div>
        </div>

        <!-- إحصائيات الحملات -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">الحملات</h2>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">إجمالي الحملات:</span>
                    <span class="font-medium">{{ $totalCampaigns }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">حملات تطوعية:</span>
                    <span class="font-medium">{{ $volunteerCampaigns }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">حملات مساعدة:</span>
                    <span class="font-medium">{{ $helpCampaigns }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">حملات نشطة:</span>
                    <span class="font-medium">{{ $activeCampaigns }}</span>
                </div>
            </div>
        </div>

        <!-- إحصائيات التبرعات -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">التبرعات</h2>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">عدد التبرعات:</span>
                    <span class="font-medium">{{ $totalDonations }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">إجمالي مبلغ التبرعات:</span>
                    <span class="font-medium">{{ $totalDonationAmount }} ريال</span>
                </div>
            </div>
        </div>

        <!-- إحصائيات التعليقات -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">التعليقات</h2>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">إجمالي التعليقات:</span>
                    <span class="font-medium">{{ $totalComments }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection