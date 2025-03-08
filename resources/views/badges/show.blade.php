@extends('layouts.app')

@section('content')
<div class="container py-8">
    <div class="mb-8">
        <a href="{{ route('badges.index') }}" class="mb-4 inline-flex items-center text-indigo-600 hover:text-indigo-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            العودة إلى الشارات
        </a>
    </div>

    <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
        <div class="md:col-span-1">
            <div class="mb-6 max-w-xs">
                <x-badge-card 
                    :badge="$badge" 
                    :earned="auth()->check() && auth()->user()->badges->contains($badge->id)" 
                    :featured="auth()->check() && auth()->user()->badges->where('id', $badge->id)->first()?->pivot?->is_featured"
                />
            </div>
        </div>
        
        <div class="md:col-span-2">
            <div class="mb-8">
                <h1 class="mb-2 text-3xl font-bold text-gray-800">{{ $badge->name }}</h1>
                <p class="text-gray-600">{{ $badge->description }}</p>
            </div>
            
            <div class="mb-6">
                <h2 class="mb-3 text-xl font-semibold">كيفية الحصول على هذه الشارة</h2>
                <div class="rounded-lg bg-gray-50 p-4">
                    @if($badge->required_points > 0)
                        <p>اكتسب <span class="font-bold text-indigo-600">{{ $badge->required_points }}</span> نقطة في المنصة.</p>
                    @elseif($badge->achievement_type && $badge->achievement_count)
                        @switch($badge->achievement_type)
                            @case('participation')
                                <p>شارك في <span class="font-bold text-indigo-600">{{ $badge->achievement_count }}</span> 
                                {{ $badge->achievement_count > 1 ? 'حملات تطوعية' : 'حملة تطوعية' }}.</p>
                                @break
                            @case('donation')
                                <p>قدم <span class="font-bold text-indigo-600">{{ $badge->achievement_count }}</span> 
                                {{ $badge->achievement_count > 1 ? 'تبرعات' : 'تبرع' }} للحملات.</p>
                                @break
                            @default
                                <p>أكمل <span class="font-bold text-indigo-600">{{ $badge->achievement_count }}</span> إنجاز.</p>
                        @endswitch
                    @endif
                </div>
            </div>
            
            <div>
                <h2 class="mb-3 text-xl font-semibold">المتطوعون الذين حصلوا على هذه الشارة</h2>
                <p class="mb-4 text-sm text-gray-600">عدد الحاصلين على هذه الشارة: <span class="font-semibold">{{ $userCount }}</span></p>
                
                @if(count($recentUsers) > 0)
                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                        @foreach($recentUsers as $user)
                            <div class="flex items-center rounded-lg border border-gray-200 p-3">
                                <div class="mr-3 h-10 w-10 overflow-hidden rounded-full">
                                    @if($user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center bg-indigo-100 text-indigo-800">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-semibold">{{ $user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($user->pivot->earned_at)->format('Y/m/d') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="rounded-lg border border-dashed border-gray-300 p-6 text-center">
                        <p class="text-gray-500">لا يوجد متطوعون حصلوا على هذه الشارة بعد. كن أول من يحصل عليها!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
