@extends('layouts.app')

@section('content')
<div class="container py-8">
    <div class="mb-8 text-center">
        <h1 class="mb-2 text-3xl font-bold text-gray-800">شاراتي</h1>
        <p class="text-gray-600">استعرض الشارات التي حصلت عليها حتى الآن</p>
    </div>

    <div class="mb-6 rounded-lg bg-gray-100 p-4">
        <div class="text-center">
            <h3 class="mb-2 text-xl font-bold">نقاطك: <span class="text-indigo-600">{{ $user->getTotalPoints() }}</span></h3>
            <p class="text-sm text-gray-600">
                ترتيبك في لوحة المتصدرين: <span class="font-semibold">{{ $user->getRank() }}</span>
            </p>
        </div>
    </div>

    @if(count($badges) > 0)
        <div class="mb-6">
            <h2 class="mb-4 text-xl font-semibold">الشارات المميزة</h2>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @php $hasFeatured = false; @endphp
                
                @foreach($badges as $badge)
                    @if($badge->pivot->is_featured)
                        @php $hasFeatured = true; @endphp
                        <x-badge-card 
                            :badge="$badge" 
                            :earned="true" 
                            :featured="true"
                            :earned-at="$badge->pivot->earned_at"
                        />
                    @endif
                @endforeach
                
                @if(!$hasFeatured)
                    <div class="col-span-full rounded-lg border border-dashed border-gray-300 p-6 text-center">
                        <p class="text-gray-500">ليس لديك أي شارات مميزة بعد. يمكنك تمييز الشارات من قائمة "جميع شاراتي".</p>
                    </div>
                @endif
            </div>
        </div>

        <div>
            <h2 class="mb-4 text-xl font-semibold">جميع شاراتي</h2>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach($badges as $badge)
                    <x-badge-card 
                        :badge="$badge" 
                        :earned="true" 
                        :featured="$badge->pivot->is_featured"
                        :earned-at="$badge->pivot->earned_at"
                    />
                @endforeach
            </div>
        </div>
    @else
        <div class="rounded-lg border border-dashed border-gray-300 p-10 text-center">
            <h3 class="mb-2 text-xl font-semibold text-gray-600">لم تحصل على أي شارات بعد</h3>
            <p class="mb-6 text-gray-500">شارك في الحملات التطوعية، قدم تبرعات، أو تفاعل مع المنصة للحصول على شارات!</p>
            <a href="{{ route('badges.index') }}" class="mt-4 inline-block rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                استعرض الشارات المتاحة
            </a>
        </div>
    @endif

    <div class="mt-8 text-center">
        <a href="{{ route('leaderboard.index') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
            عرض لوحة المتصدرين
        </a>
    </div>
</div>
@endsection
