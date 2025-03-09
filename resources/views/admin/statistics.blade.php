@extends('admin.layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">إحصائيات المنصة</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">نظرة عامة على أداء منصة التطوع</p>
    </div>

    <!-- بطاقات الإحصائيات -->
    <div class="grid grid-cols-1 gap-5 mt-6 sm:grid-cols-2 lg:grid-cols-4">
        <div class="p-5 bg-white rounded-lg shadow dark:bg-gray-800">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 text-white bg-blue-600 rounded-md dark:bg-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div class="flex-1 mr-3 rtl:mr-0 rtl:ml-3">
                    <p class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">إجمالي المستخدمين</p>
                    <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $totalUsers }}</p>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        <span class="font-medium text-green-600 dark:text-green-400">+{{ $newUsersThisMonth }}</span> هذا الشهر
                    </div>
                </div>
            </div>
        </div>

        <div class="p-5 bg-white rounded-lg shadow dark:bg-gray-800">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 text-white bg-green-600 rounded-md dark:bg-green-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div class="flex-1 mr-3 rtl:mr-0 rtl:ml-3">
                    <p class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">إجمالي الحملات</p>
                    <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $totalCampaigns }}</p>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        <span class="font-medium text-green-600 dark:text-green-400">+{{ $newCampaignsThisMonth }}</span> هذا الشهر
                    </div>
                </div>
            </div>
        </div>

        <div class="p-5 bg-white rounded-lg shadow dark:bg-gray-800">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 text-white bg-yellow-600 rounded-md dark:bg-yellow-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="flex-1 mr-3 rtl:mr-0 rtl:ml-3">
                    <p class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">طلبات المشاركة</p>
                    <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $totalParticipationRequests }}</p>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        <span class="font-medium text-green-600 dark:text-green-400">{{ $approvedParticipationRequests }}</span> مقبولة
                    </div>
                </div>
            </div>
        </div>

        <div class="p-5 bg-white rounded-lg shadow dark:bg-gray-800">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 text-white bg-purple-600 rounded-md dark:bg-purple-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1 mr-3 rtl:mr-0 rtl:ml-3">
                    <p class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">إجمالي التبرعات</p>
                    <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ number_format($totalDonations, 2) }}</p>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center justify-between">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                        <span class="font-medium text-green-600 dark:text-green-400">{{ number_format($donationsThisMonth, 2) }}</span> هذا الشهر
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- الرسوم البيانية -->
    <div class="grid grid-cols-1 gap-5 mt-8 lg:grid-cols-2">
        <!-- رسم بياني للمستخدمين الجدد -->
        <div class="p-5 bg-white rounded-lg shadow dark:bg-gray-800">
            <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">المستخدمين الجدد</h3>
            <div class="relative" style="height: 350px;">
                <canvas id="newUsersChart"></canvas>
            </div>
        </div>

        <!-- رسم بياني للحملات -->
        <div class="p-5 bg-white rounded-lg shadow dark:bg-gray-800">
            <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">الحملات حسب الحالة</h3>
            <div class="relative" style="height: 350px;">
                <canvas id="campaignsChart"></canvas>
            </div>
        </div>

        <!-- رسم بياني للتبرعات -->
        <div class="p-5 bg-white rounded-lg shadow dark:bg-gray-800">
            <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">التبرعات الشهرية</h3>
            <div class="relative" style="height: 350px;">
                <canvas id="donationsChart"></canvas>
            </div>
        </div>

        <!-- رسم بياني لطلبات المشاركة -->
        <div class="p-5 bg-white rounded-lg shadow dark:bg-gray-800">
            <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">طلبات المشاركة</h3>
            <div class="relative" style="height: 350px;">
                <canvas id="participationRequestsChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // بيانات المستخدمين الجدد
        const newUsersCtx = document.getElementById('newUsersChart').getContext('2d');
        const newUsersChart = new Chart(newUsersCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($userChartLabels) !!},
                datasets: [{
                    label: 'المستخدمين الجدد',
                    data: {!! json_encode($userChartData) !!},
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        // بيانات الحملات حسب الحالة
        const campaignsCtx = document.getElementById('campaignsChart').getContext('2d');
        const campaignsChart = new Chart(campaignsCtx, {
            type: 'doughnut',
            data: {
                labels: ['نشطة', 'مسودة', 'مكتملة', 'ملغاة'],
                datasets: [{
                    data: [
                        {{ $activeCampaigns }}, 
                        {{ $draftCampaigns }}, 
                        {{ $completedCampaigns }}, 
                        {{ $cancelledCampaigns }}
                    ],
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.8)',
                        'rgba(234, 179, 8, 0.8)',
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    borderColor: [
                        'rgba(34, 197, 94, 1)',
                        'rgba(234, 179, 8, 1)',
                        'rgba(59, 130, 246, 1)',
                        'rgba(239, 68, 68, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // بيانات التبرعات الشهرية
        const donationsCtx = document.getElementById('donationsChart').getContext('2d');
        const donationsChart = new Chart(donationsCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($donationChartLabels) !!},
                datasets: [{
                    label: 'التبرعات',
                    data: {!! json_encode($donationChartData) !!},
                    backgroundColor: 'rgba(124, 58, 237, 0.6)',
                    borderColor: 'rgba(124, 58, 237, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // بيانات طلبات المشاركة
        const participationRequestsCtx = document.getElementById('participationRequestsChart').getContext('2d');
        const participationRequestsChart = new Chart(participationRequestsCtx, {
            type: 'pie',
            data: {
                labels: ['مقبولة', 'معلقة', 'مرفوضة'],
                datasets: [{
                    data: [
                        {{ $approvedParticipationRequests }}, 
                        {{ $pendingParticipationRequests }}, 
                        {{ $rejectedParticipationRequests }}
                    ],
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.8)',
                        'rgba(234, 179, 8, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    borderColor: [
                        'rgba(34, 197, 94, 1)',
                        'rgba(234, 179, 8, 1)',
                        'rgba(239, 68, 68, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    });
</script>
@endpush