@extends('layouts.app')

@section('content')
<div class="container py-8">
    <div class="mb-8 text-center">
        <h1 class="mb-2 text-3xl font-bold text-gray-800">لوحة المتصدرين - المشاركة</h1>
        <p class="text-gray-600">أكثر المتطوعين مشاركة في الحملات التطوعية</p>
    </div>

    <div class="mb-8">
        <div class="mb-6 flex flex-wrap justify-center space-x-2 space-x-reverse">
            <a href="{{ route('leaderboard.index') }}" class="mb-2 rounded-lg bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300">
                النقاط الكلية
            </a>
            <a href="{{ route('leaderboard.participation') }}" class="mb-2 rounded-lg bg-indigo-600 px-4 py-2 text-white">
                المشاركة في الحملات
            </a>
            <a href="{{ route('leaderboard.donation') }}" class="mb-2 rounded-lg bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300">
                التبرعات
            </a>
        </div>
        
        <!-- نموذج البحث -->
        <div class="mb-6 mx-auto max-w-md">
            <form action="{{ route('leaderboard.search') }}" method="GET" class="space-y-3">
                <input type="hidden" name="type" value="participation">
                <div class="relative flex-grow">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="ابحث عن متطوع..." 
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-700 focus:border-indigo-500 focus:outline-none">
                    <button type="submit" class="absolute inset-y-0 left-0 flex items-center px-3 text-indigo-600">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- تصفية حسب نوع المستخدم -->
                <div class="flex flex-wrap items-center justify-center gap-2">
                    <span class="text-gray-700">تصفية حسب النوع:</span>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('leaderboard.participation') }}" class="rounded-lg {{ !request('user_type') ? 'bg-indigo-100 text-indigo-800' : 'bg-gray-100 text-gray-700' }} px-3 py-1 text-sm">
                            الكل
                        </a>
                        <a href="{{ route('leaderboard.participation', ['user_type' => 'regular']) }}" class="rounded-lg {{ request('user_type') == 'regular' ? 'bg-indigo-100 text-indigo-800' : 'bg-gray-100 text-gray-700' }} px-3 py-1 text-sm">
                            أفراد
                        </a>
                        <a href="{{ route('leaderboard.participation', ['user_type' => 'team']) }}" class="rounded-lg {{ request('user_type') == 'team' ? 'bg-indigo-100 text-indigo-800' : 'bg-gray-100 text-gray-700' }} px-3 py-1 text-sm">
                            فرق
                        </a>
                        <a href="{{ route('leaderboard.participation', ['user_type' => 'organization']) }}" class="rounded-lg {{ request('user_type') == 'organization' ? 'bg-indigo-100 text-indigo-800' : 'bg-gray-100 text-gray-700' }} px-3 py-1 text-sm">
                            منظمات
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="mx-auto max-w-4xl">
        @if((isset($search) && $search && $topUsers->isEmpty()) || (isset($userType) && $userType && $topUsers->isEmpty()))
            <div class="mb-8 rounded-lg bg-yellow-50 p-4 text-center">
                <p class="text-yellow-700">
                    <span class="mb-2 block text-lg font-semibold">لا توجد نتائج</span>
                    @if(isset($search) && $search)
                        لم يتم العثور على متطوعين بالاسم "{{ $search }}"
                        @if(isset($userType) && $userType)
                            من نوع {{ $userType == 'regular' ? 'الأفراد' : ($userType == 'team' ? 'الفرق' : 'المنظمات') }}
                        @endif
                    @elseif(isset($userType) && $userType)
                        لم يتم العثور على متطوعين من نوع {{ $userType == 'regular' ? 'الأفراد' : ($userType == 'team' ? 'الفرق' : 'المنظمات') }}
                    @endif
                    . حاول استخدام معايير تصفية مختلفة.
                </p>
                <a href="{{ route('leaderboard.participation') }}" class="mt-2 inline-block rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                    عرض جميع المتطوعين
                </a>
            </div>
        @else
            <!-- Top 3 users (medals) -->
            <div class="mb-8">
                <div class="flex flex-wrap items-end justify-center">
                    <!-- Second Place -->
                    @if(isset($topUsers[1]))
                        <div class="mx-3 text-center">
                            <div class="relative">
                                <div class="mb-2 flex h-16 w-16 items-center justify-center rounded-full border-4 border-gray-300 bg-gray-100 text-4xl font-bold text-gray-700 md:h-24 md:w-24">
                                    <span class="flex h-full w-full items-center justify-center">
                                        @if($topUsers[1]->avatar)
                                            <img src="{{ asset('storage/' . $topUsers[1]->avatar) }}" alt="{{ $topUsers[1]->name }}" class="h-full w-full rounded-full object-cover">
                                        @else
                                            {{ strtoupper(substr($topUsers[1]->name, 0, 1)) }}
                                        @endif
                                    </span>
                                </div>
                                <div class="absolute bottom-0 right-0 flex h-8 w-8 items-center justify-center rounded-full bg-gray-300 text-gray-700 shadow-md">
                                    <span class="text-sm font-bold">2</span>
                                </div>
                            </div>
                            <h3 class="mt-2 font-semibold">{{ $topUsers[1]->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $topUsers[1]->participation_count }} مشاركة</p>
                        </div>
                    @endif
                    
                    <!-- First Place -->
                    @if(isset($topUsers[0]))
                        <div class="mx-3 -mb-4 text-center">
                            <div class="relative">
                                <div class="mb-2 flex h-20 w-20 items-center justify-center rounded-full border-4 border-yellow-400 bg-yellow-100 text-4xl font-bold text-yellow-700 md:h-32 md:w-32">
                                    <span class="flex h-full w-full items-center justify-center">
                                        @if($topUsers[0]->avatar)
                                            <img src="{{ asset('storage/' . $topUsers[0]->avatar) }}" alt="{{ $topUsers[0]->name }}" class="h-full w-full rounded-full object-cover">
                                        @else
                                            {{ strtoupper(substr($topUsers[0]->name, 0, 1)) }}
                                        @endif
                                    </span>
                                </div>
                                <div class="absolute bottom-0 right-0 flex h-10 w-10 items-center justify-center rounded-full bg-yellow-400 text-yellow-800 shadow-md">
                                    <span class="text-lg font-bold">1</span>
                                </div>
                                <div class="absolute left-1/2 top-0 -translate-x-1/2 -translate-y-1/4 transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z"/>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="mt-2 text-lg font-bold">{{ $topUsers[0]->name }}</h3>
                            <p class="text-sm font-semibold text-gray-600">{{ $topUsers[0]->participation_count }} مشاركة</p>
                        </div>
                    @endif
                    
                    <!-- Third Place -->
                    @if(isset($topUsers[2]))
                        <div class="mx-3 text-center">
                            <div class="relative">
                                <div class="mb-2 flex h-16 w-16 items-center justify-center rounded-full border-4 border-amber-700 bg-amber-100 text-4xl font-bold text-amber-700 md:h-24 md:w-24">
                                    <span class="flex h-full w-full items-center justify-center">
                                        @if($topUsers[2]->avatar)
                                            <img src="{{ asset('storage/' . $topUsers[2]->avatar) }}" alt="{{ $topUsers[2]->name }}" class="h-full w-full rounded-full object-cover">
                                        @else
                                            {{ strtoupper(substr($topUsers[2]->name, 0, 1)) }}
                                        @endif
                                    </span>
                                </div>
                                <div class="absolute bottom-0 right-0 flex h-8 w-8 items-center justify-center rounded-full bg-amber-700 text-white shadow-md">
                                    <span class="text-sm font-bold">3</span>
                                </div>
                            </div>
                            <h3 class="mt-2 font-semibold">{{ $topUsers[2]->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $topUsers[2]->participation_count }} مشاركة</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Leaderboard Table -->
            <div class="overflow-hidden rounded-lg border border-gray-200 shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">
                                المرتبة
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">
                                المتطوع
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">
                                عدد المشاركات
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">
                                آخر مشاركة
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($topUsers as $index => $user)
                            <tr class="{{ auth()->check() && auth()->id() == $user->id ? 'bg-indigo-50' : '' }}">
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                    {{ $index + 1 }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0">
                                            @if($user->avatar)
                                                <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}">
                                            @else
                                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 text-indigo-600">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="mr-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                    <span class="font-semibold text-indigo-600">{{ $user->participation_count }}</span> مشاركة
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                    {{ $user->last_participation ? \Carbon\Carbon::parse($user->last_participation)->format('Y/m/d') : '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if(method_exists($topUsers, 'links'))
                <div class="mt-6">
                    {{ $topUsers->links() }}
                </div>
            @endif

            @auth
                <div class="mt-8 rounded-lg bg-gray-50 p-4">
                    <h3 class="mb-2 text-lg font-semibold">ترتيبك في المشاركات</h3>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="h-12 w-12 flex-shrink-0">
                                @if(auth()->user()->avatar)
                                    <img class="h-12 w-12 rounded-full" src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}">
                                @else
                                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-indigo-100 text-indigo-600">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <div class="mr-4">
                                <div class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</div>
                                <div class="text-sm text-gray-500">{{ auth()->user()->email }}</div>
                            </div>
                        </div>
                        <div>
                            <span class="font-semibold">المرتبة:</span> {{ $currentUserRank ?? '-' }}
                            <p><span class="font-semibold">عدد المشاركات:</span> {{ $currentUserParticipationCount ?? auth()->user()->participationRequests()->whereNotNull('approved_at')->count() }}</p>
                        </div>
                    </div>
                </div>
            @endauth
        @endif
    </div>
</div>
@endsection
