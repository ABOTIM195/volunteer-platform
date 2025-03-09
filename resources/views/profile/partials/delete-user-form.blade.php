<section class="space-y-6 bg-white dark:bg-gray-800 rounded-lg p-6 shadow-md">
    <header class="border-r-4 border-red-500 pr-4">
        <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 text-right">
            {{ __('حذف الحساب') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 text-right">
            {{ __('بمجرد حذف حسابك، سيتم حذف جميع موارده وبياناته نهائيًا. قبل حذف حسابك، يرجى تنزيل أي بيانات أو معلومات ترغب في الاحتفاظ بها.') }}
        </p>
    </header>

    <div class="mt-5 border-t border-gray-200 dark:border-gray-700 pt-5">
        <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="mr-auto ml-0 block bg-gradient-to-r from-red-500 to-red-700 hover:from-red-600 hover:to-red-800 transition-all duration-300 shadow-md"
        >
            <span class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                {{ __('حذف الحساب') }}
            </span>
        </x-danger-button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 text-right">
            @csrf
            @method('delete')

            <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 border-r-4 border-red-500 pr-4">
                {{ __('هل أنت متأكد من رغبتك في حذف حسابك؟') }}
            </h2>

            <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">
                {{ __('بمجرد حذف حسابك، سيتم حذف جميع موارده وبياناته نهائيًا. الرجاء إدخال كلمة المرور الخاصة بك لتأكيد رغبتك في حذف حسابك بشكل دائم.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('كلمة المرور') }}" class="block text-right mb-1 font-medium text-gray-700 dark:text-gray-300" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full text-right border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-red-500 dark:focus:border-red-600 focus:ring-red-500 dark:focus:ring-red-600 rounded-md shadow-sm"
                    placeholder="{{ __('أدخل كلمة المرور الخاصة بك') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-right" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')" class="hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200">
                    {{ __('إلغاء') }}
                </x-secondary-button>

                <x-danger-button class="mr-3 bg-gradient-to-r from-red-500 to-red-700 hover:from-red-600 hover:to-red-800 transition-all duration-300">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ __('حذف الحساب') }}
                    </span>
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>