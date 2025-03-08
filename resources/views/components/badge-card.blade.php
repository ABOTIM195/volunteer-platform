@php
// تعريف القيم الافتراضية للمتغيرات
$earned = $earned ?? false;
$featured = $featured ?? false;
$showDetails = $showDetails ?? false;
$earnedAt = $earnedAt ?? null;
@endphp

<div class="badge-card {{ $earned ? 'earned' : 'not-earned' }} {{ $featured ? 'featured' : '' }} rounded-lg p-4 text-center shadow-md transition-all hover:shadow-lg" style="border: 2px solid {{ $badge->color }};">
    <div class="badge-icon mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-full text-white" style="background-color: {{ $badge->color }};">
        <i class="fa {{ $badge->icon }} fa-2x"></i>
    </div>

    <h4 class="mb-1 text-lg font-bold">{{ $badge->name }}</h4>
    
    @if ($showDetails)
        <p class="mb-3 text-sm text-gray-600">{{ $badge->description }}</p>
    @endif
    
    @if ($earned && $earnedAt)
        <div class="mt-2 text-xs text-gray-500">
            <span class="font-semibold text-green-600">تم الحصول عليها</span>
            <br>
            <span>{{ \Carbon\Carbon::parse($earnedAt)->format('Y/m/d') }}</span>
        </div>
    @elseif (!$earned && $showDetails)
        <div class="mt-2 text-xs text-gray-500">
            @if ($badge->required_points > 0)
                <p>مطلوب {{ $badge->required_points }} نقطة</p>
            @elseif ($badge->achievement_type && $badge->achievement_count)
                <p>مطلوب 
                    {{ $badge->achievement_count }} 
                    @switch($badge->achievement_type)
                        @case('participation')
                            مشاركة
                            @break
                        @case('donation')
                            تبرع
                            @break
                        @default
                            إنجاز
                    @endswitch
                </p>
            @endif
        </div>
    @endif
    
    @if ($earned && auth()->check())
        <form action="{{ route('badges.toggle-featured', $badge) }}" method="POST" class="mt-2">
            @csrf
            <input type="hidden" name="is_featured" value="{{ $featured ? '0' : '1' }}">
            <button type="submit" class="text-xs text-blue-600 hover:underline">
                {{ $featured ? 'إلغاء التمييز' : 'تمييز الشارة' }}
            </button>
        </form>
    @endif
</div>