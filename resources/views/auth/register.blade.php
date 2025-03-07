<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-gradient-to-br from-teal-50 to-emerald-50 dark:from-gray-900 dark:to-gray-800">
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-2xl relative z-10">
            <!-- زخارف الخلفية -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
                <div class="absolute -top-24 -right-24 w-48 h-48 rounded-full bg-gradient-to-br from-teal-100 to-teal-200 dark:from-teal-900/20 dark:to-teal-800/20 blur-3xl opacity-70"></div>
                <div class="absolute -bottom-24 -left-24 w-48 h-48 rounded-full bg-gradient-to-br from-emerald-100 to-emerald-200 dark:from-emerald-900/20 dark:to-emerald-800/20 blur-3xl opacity-70"></div>
            </div>
            
            <div class="mb-8 text-center">
                <a href="{{ route('home') }}" class="inline-block">
                    <div class="text-3xl font-bold bg-gradient-to-r from-teal-500 to-emerald-600 bg-clip-text text-transparent mb-1">منصة التطوع</div>
                </a>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mt-4">إنشاء حساب جديد</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">انضم إلينا وكن جزءاً من التغيير الإيجابي</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('الاسم')" class="text-gray-700 dark:text-gray-300" />
                    <div class="relative mt-1 group">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400 group-focus-within:text-teal-500 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <x-text-input id="name" class="block mt-1 w-full pr-10 border-gray-300 dark:border-gray-600 focus:border-teal-500 focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:ring-teal-500 rounded-lg shadow-sm" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="أدخل اسمك الكامل" />
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('البريد الإلكتروني')" class="text-gray-700 dark:text-gray-300" />
                    <div class="relative mt-1 group">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400 group-focus-within:text-teal-500 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                        <x-text-input id="email" class="block mt-1 w-full pr-10 border-gray-300 dark:border-gray-600 focus:border-teal-500 focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:ring-teal-500 rounded-lg shadow-sm" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="example@email.com" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Phone Number -->
                <div>
                    <x-input-label for="phone" :value="__('رقم الهاتف')" class="text-gray-700 dark:text-gray-300" />
                    <div class="relative mt-1 group">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400 group-focus-within:text-teal-500 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                            </svg>
                        </div>
                        <x-text-input id="phone" class="block mt-1 w-full pr-10 border-gray-300 dark:border-gray-600 focus:border-teal-500 focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:ring-teal-500 rounded-lg shadow-sm" type="tel" name="phone" :value="old('phone')" placeholder="05xxxxxxxx" />
                    </div>
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- User Type -->
                <div>
                    <x-input-label for="type" :value="__('نوع الحساب')" class="text-gray-700 dark:text-gray-300" />
                    <div class="relative mt-1 group">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400 group-focus-within:text-teal-500 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                            </svg>
                        </div>
                        <select id="type" name="type" class="block mt-1 w-full pr-10 border-gray-300 dark:border-gray-600 focus:border-teal-500 focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:ring-teal-500 dark:bg-gray-700 dark:text-gray-300 rounded-lg shadow-sm" required>
                            <option value="" disabled selected>اختر نوع الحساب</option>
                            <option value="regular" {{ old('type') == 'regular' ? 'selected' : '' }}>متطوع</option>
                            <option value="team" {{ old('type') == 'team' ? 'selected' : '' }}>فريق تطوعي</option>
                            <option value="organization" {{ old('type') == 'organization' ? 'selected' : '' }}>منظمة</option>
                        </select>
                    </div>
                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                </div>

                <!-- Description for teams and organizations -->
                <div id="description-container" class="hidden">
                    <x-input-label for="description" :value="__('نبذة تعريفية')" class="text-gray-700 dark:text-gray-300" />
                    <div class="relative mt-1">
                        <textarea id="description" name="description" rows="3" class="block w-full border-gray-300 dark:border-gray-600 focus:border-teal-500 focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:ring-teal-500 dark:bg-gray-700 dark:text-gray-300 rounded-lg shadow-sm" placeholder="اكتب نبذة تعريفية عن الفريق أو المنظمة">{{ old('description') }}</textarea>
                    </div>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('كلمة المرور')" class="text-gray-700 dark:text-gray-300" />
                    <div class="relative mt-1 group">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400 group-focus-within:text-teal-500 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <button type="button" id="toggle-password" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" id="show-password" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" id="hide-password" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        <x-text-input id="password" class="block mt-1 w-full pr-10 pl-10 border-gray-300 dark:border-gray-600 focus:border-teal-500 focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:ring-teal-500 rounded-lg shadow-sm"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" 
                                        placeholder="********" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                               <!-- Confirm Password -->
                               <div>
                    <x-input-label for="password_confirmation" :value="__('تأكيد كلمة المرور')" class="text-gray-700 dark:text-gray-300" />
                    <div class="relative mt-1 group">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400 group-focus-within:text-teal-500 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <button type="button" id="toggle-confirm-password" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" id="show-confirm-password" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" id="hide-confirm-password" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        <x-text-input id="password_confirmation" class="block mt-1 w-full pr-10 pl-10 border-gray-300 dark:border-gray-600 focus:border-teal-500 focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:ring-teal-500 rounded-lg shadow-sm"
                                        type="password"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="********" />
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a class="text-sm text-teal-600 hover:text-teal-700 dark:text-teal-400 dark:hover:text-teal-300 transition-colors duration-200" href="{{ route('login') }}">
                        {{ __('لديك حساب بالفعل؟') }}
                    </a>

                    <x-primary-button class="bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-600 hover:to-emerald-700 transform hover:scale-105 transition-all duration-200">
                        {{ __('إنشاء حساب') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle description for team/organization
            const typeSelect = document.getElementById('type');
            const descriptionContainer = document.getElementById('description-container');
            
            function toggleDescription() {
                if (typeSelect.value === 'team' || typeSelect.value === 'organization') {
                    descriptionContainer.classList.remove('hidden');
                } else {
                    descriptionContainer.classList.add('hidden');
                }
            }
            
            typeSelect.addEventListener('change', toggleDescription);
            toggleDescription();

            // Toggle password visibility
            function setupPasswordToggle(toggleId, inputId, showIconId, hideIconId) {
                const toggleBtn = document.getElementById(toggleId);
                const input = document.getElementById(inputId);
                const showIcon = document.getElementById(showIconId);
                const hideIcon = document.getElementById(hideIconId);

                toggleBtn.addEventListener('click', function() {
                    if (input.type === 'password') {
                        input.type = 'text';
                        showIcon.classList.add('hidden');
                        hideIcon.classList.remove('hidden');
                    } else {
                        input.type = 'password';
                        showIcon.classList.remove('hidden');
                        hideIcon.classList.add('hidden');
                    }
                });
            }

            setupPasswordToggle('toggle-password', 'password', 'show-password', 'hide-password');
            setupPasswordToggle('toggle-confirm-password', 'password_confirmation', 'show-confirm-password', 'hide-confirm-password');
        });
    </script>
</x-guest-layout>