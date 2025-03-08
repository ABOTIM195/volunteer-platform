@extends('layouts.app')

@section('content')
<div class="container py-8">
    <div class="mb-8 text-center">
        <h1 class="mb-2 text-3xl font-bold text-gray-800">شارات الإنجاز</h1>
        <p class="text-gray-600">اكتشف جميع الشارات المتاحة في منصتنا وكيفية الحصول عليها</p>
    </div>

    <div class="mb-6">
        <div class="mb-4">
            <h2 class="mb-1 text-xl font-semibold text-gray-800">نظام الشارات</h2>
            <p class="text-gray-600">
                تعكس الشارات إنجازاتك وتفاعلك في المنصة. اكتسب النقاط من خلال المشاركة في حملات تطوعية، التبرع للحملات، التعليق ومشاركة المحتوى مع الآخرين.
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        @foreach($badges as $badge)
            <a href="{{ route('badges.show', $badge) }}" class="block transition-transform hover:-translate-y-1">
                <x-badge-card 
                    :badge="$badge" 
                    :earned="in_array($badge->id, $userBadges)" 
                />
            </a>
        @endforeach
    </div>

    @auth
        <div class="mt-8 text-center">
            <a href="{{ route('badges.user') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                عرض شاراتي
            </a>
        </div>
    @endauth
</div>
@endsection
