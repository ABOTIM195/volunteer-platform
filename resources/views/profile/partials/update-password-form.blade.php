<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 text-right">
            {{ __('تحديث كلمة المرور') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 text-right">
            {{ __('تأكد من استخدام كلمة مرور طويلة وعشوائية للحفاظ على أمان حسابك.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="text-right">
            <x-input-label for="current_password" :value="__('كلمة المرور الحالية')" class="text-right" />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-right" />
        </div>

        <div class="text-right">
            <x-input-label for="password" :value="__('كلمة المرور الجديدة')" class="text-right" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-right" />
        </div>

        <div class="text-right">
            <x-input-label for="password_confirmation" :value="__('تأكيد كلمة المرور')" class="text-right" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-right" />
        </div>

        <div class="flex items-center gap-4 justify-end">
            <x-primary-button>{{ __('حفظ') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('تم الحفظ.') }}</p>
            @endif
        </div>
    </form>
</section>