<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 text-right">
            {{ __('معلومات الملف الشخصي') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 text-right">
            {{ __('قم بتحديث معلومات ملفك الشخصي وعنوان بريدك الإلكتروني.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- الاسم -->
            <div class="text-right">
                <x-input-label for="name" :value="__('الاسم')" class="text-right" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full text-right" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2 text-right" :messages="$errors->get('name')" />
            </div>

            <!-- البريد الإلكتروني -->
            <div class="text-right">
                <x-input-label for="email" :value="__('البريد الإلكتروني')" class="text-right" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full text-right" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2 text-right" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="text-right">
                        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                            {{ __('عنوان بريدك الإلكتروني غير مؤكد.') }}

                            <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('انقر هنا لإعادة إرسال رسالة التحقق.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('تم إرسال رابط تحقق جديد إلى عنوان بريدك الإلكتروني.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <!-- رقم الهاتف -->
            <div class="text-right">
                <x-input-label for="phone" :value="__('رقم الهاتف')" class="text-right" />
                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone ?? '')" dir="ltr" />
                <x-input-error class="mt-2 text-right" :messages="$errors->get('phone')" />
            </div>

            <!-- المدينة -->
            <div class="text-right">
                <x-input-label for="city" :value="__('المدينة')" class="text-right" />
                <x-text-input id="city" name="city" type="text" class="mt-1 block w-full text-right" :value="old('city', $user->city ?? '')" />
                <x-input-error class="mt-2 text-right" :messages="$errors->get('city')" />
            </div>

            <!-- نبذة عني -->
            <div class="col-span-1 md:col-span-2 text-right">
                <x-input-label for="bio" :value="__('نبذة عني')" class="text-right" />
                <textarea id="bio" name="bio" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm text-right" rows="4">{{ old('bio', $user->bio ?? '') }}</textarea>
                <x-input-error class="mt-2 text-right" :messages="$errors->get('bio')" />
            </div>

            <!-- صورة الملف الشخصي -->
            <div class="col-span-1 md:col-span-2 text-right">
                <x-input-label for="profile_photo" :value="__('صورة الملف الشخصي')" class="text-right" />
                <div class="mt-2 flex items-center flex-row-reverse">
                    <div class="mr-4 relative">
                        <div class="w-20 h-20 rounded-full overflow-hidden bg-gray-100 dark:bg-gray-700">
                            @if(Auth::user()->profile_photo_path)
                                <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="text-2xl text-gray-500 dark:text-gray-400">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="flex-1">
                        <input id="profile_photo" name="profile_photo" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" accept="image/*" />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 text-right">PNG، JPG أو GIF (الحد الأقصى 2 ميجابايت)</p>
                    </div>
                </div>
                <x-input-error class="mt-2 text-right" :messages="$errors->get('profile_photo')" />
            </div>
        </div>

        <div class="flex items-center gap-4 mt-6 justify-end">
            <x-primary-button class="bg-gradient-to-r from-teal-500 to-blue-600 hover:from-teal-600 hover:to-blue-700">{{ __('حفظ') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
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