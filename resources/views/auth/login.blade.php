<x-guest-layout>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- بطاقة تسجيل الدخول -->
                <div class="card">
                    <div class="card-body">
                        <!-- الشعار -->
                        <div class="app-brand justify-content-center mb-4">
                            <a href="{{ route('home') }}" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <defs>
                                            <path d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z" id="path-1"></path>
                                            <path d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z" id="path-3"></path>
                                            <path d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z" id="path-4"></path>
                                        </defs>
                                        <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                                                <g id="Icon" transform="translate(27.000000, 15.000000)">
                                                    <g id="Mask" transform="translate(0.000000, 8.000000)">
                                                        <mask id="mask-2" fill="white">
                                                            <use xlink:href="#path-1"></use>
                                                        </mask>
                                                        <use fill="#14B8A6" xlink:href="#path-1"></use>
                                                        <g id="Path-3" mask="url(#mask-2)">
                                                            <use fill="#14B8A6" xlink:href="#path-3"></use>
                                                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                                                        </g>
                                                        <g id="Path-4" mask="url(#mask-2)">
                                                            <use fill="#14B8A6" xlink:href="#path-4"></use>
                                                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </span>
                                <span class="app-brand-text demo text-body fw-bolder">منصة التطوع</span>
                            </a>
                        </div>
                        <!-- /الشعار -->
                        <h4 class="mb-2 fw-bold">مرحباً بك في منصة التطوع! 👋</h4>
                        <p class="mb-4">يرجى تسجيل الدخول إلى حسابك وبدء المساهمة</p>

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">البريد الإلكتروني</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    placeholder="أدخل بريدك الإلكتروني"
                                    autofocus
                                    :value="old('email')"
                                    required
                                />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">كلمة المرور</label>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">
                                            <small>نسيت كلمة المرور؟</small>
                                        </a>
                                    @endif
                                </div>
                                <div class="input-group input-group-merge">
                                    <input
                                        type="password"
                                        id="password"
                                        class="form-control"
                                        name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password"
                                        required
                                    />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember_me" name="remember" />
                                    <label class="form-check-label" for="remember_me"> تذكرني </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">تسجيل الدخول</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>جديد في منصتنا؟</span>
                            <a href="{{ route('register') }}">
                                <span>إنشاء حساب</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>

    <style>
        /* تنسيقات مشابهة لتصميم Sneat */
        :root {
            --bs-blue: #696cff;
            --bs-primary: #14B8A6;
            --bs-primary-rgb: 20, 184, 166;
        }
        
        .container-xxl {
            max-width: 1400px;
            width: 100%;
            margin-right: auto;
            margin-left: auto;
        }
        
        .authentication-wrapper {
            display: flex;
            flex-basis: 100%;
            min-height: 100vh;
            width: 100%;
        }
        
        .authentication-basic {
            align-items: center;
            justify-content: center;
        }
        
        .authentication-inner {
            max-width: 400px;
            width: 100%;
        }
        
        .container-p-y {
            padding-top: 1.625rem !important;
            padding-bottom: 1.625rem !important;
        }
        
        .card {
            box-shadow: 0 2px 6px 0 rgba(67, 89, 113, 0.12);
            border: 0 solid #d9dee3;
            border-radius: 0.5rem;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .app-brand {
            display: flex;
            flex-grow: 0;
            flex-shrink: 0;
            overflow: hidden;
            line-height: 1;
            min-height: 1px;
            margin-bottom: 1rem;
        }
        
        .app-brand-link {
            display: flex;
            align-items: center;
            text-decoration: none;
        }
        
        .app-brand-logo {
            display: block;
            flex-grow: 0;
            flex-shrink: 0;
            overflow: hidden;
            min-height: 1px;
        }
        
        .app-brand-text {
            flex-shrink: 0;
            opacity: 1;
            transition: opacity 0.15s ease-in-out;
            font-size: 1.5rem;
            font-weight: 700;
            color: #566a7f;
        }
        
        .justify-content-center {
            justify-content: center !important;
        }
        
        .mb-2 {
            margin-bottom: 0.5rem !important;
        }
        
        .mb-3 {
            margin-bottom: 1rem !important;
        }
        
        .mb-4 {
            margin-bottom: 1.5rem !important;
        }
        
        .fw-bolder {
            font-weight: 700 !important;
        }
        
        .form-label {
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: #566a7f;
        }
        
        .form-control {
            display: block;
            width: 100%;
            padding: 0.4375rem 0.875rem;
            font-size: 0.9375rem;
            font-weight: 400;
            line-height: 1.53;
            color: #697a8d;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #d9dee3;
            appearance: none;
            border-radius: 0.375rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        
        .form-control:focus {
            color: #697a8d;
            background-color: #fff;
            border-color: #14B8A6;
            outline: 0;
            box-shadow: 0 0 0.25rem 0.05rem rgba(20, 184, 166, 0.1);
        }
        
        .input-group {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
            width: 100%;
        }
        
        .input-group-merge .form-control:not(:last-child) {
            padding-right: 0.875rem;
            border-top-right-radius: 0.375rem;
            border-bottom-right-radius: 0.375rem;
        }
        
        .input-group:not(.has-validation)>.dropdown-toggle:nth-last-child(n+3), .input-group:not(.has-validation)>:not(:last-child):not(.dropdown-toggle):not(.dropdown-menu) {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        
        .input-group-text {
            display: flex;
            align-items: center;
            padding: 0.4375rem 0.875rem;
            font-size: 0.9375rem;
            font-weight: 400;
            line-height: 1.53;
            color: #697a8d;
            text-align: center;
            white-space: nowrap;
            background-color: #fff;
            border: 1px solid #d9dee3;
            border-radius: 0.375rem;
        }
        
        .input-group-merge .input-group-text:last-child {
            border-left: 0;
            border-top-left-radius: 0.375rem;
            border-bottom-left-radius: 0.375rem;
        }
        
        .cursor-pointer {
            cursor: pointer;
        }
        
        .form-check {
            display: block;
            min-height: 1.5rem;
            padding-left: 1.5em;
            margin-bottom: 0.125rem;
        }
        
        .form-check-input {
            width: 1em;
            height: 1em;
            margin-top: 0.25em;
            vertical-align: top;
            background-color: #fff;
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            border: 1px solid #d9dee3;
            appearance: none;
            color-adjust: exact;
            transition: background-color 0.15s ease-in-out, background-position 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        
        .form-check-input[type=checkbox] {
            border-radius: 0.25em;
        }
        
        .form-check-input:checked {
            background-color: #14B8A6;
            border-color: #14B8A6;
        }
        
        .form-check-input:checked[type=checkbox] {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e");
        }
        
        .form-check-label {
            color: #697a8d;
            cursor: pointer;
        }
        
        .d-flex {
            display: flex !important;
        }
        
        .justify-content-between {
            justify-content: space-between !important;
        }
        
        .d-grid {
            display: grid !important;
        }
        
        .w-100 {
            width: 100% !important;
        }
        
        .btn {
            display: inline-block;
            font-weight: 400;
            line-height: 1.53;
            color: #697a8d;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.4375rem 1.25rem;
            font-size: 0.9375rem;
            border-radius: 0.375rem;
            transition: all 0.2s ease-in-out;
        }
        
        .btn-primary {
            color: #fff;
            background-color: #14B8A6;
            border-color: #14B8A6;
            box-shadow: 0 0.125rem 0.25rem 0 rgba(20, 184, 166, 0.4);
        }
        
        .btn-primary:hover {
            color: #fff;
            background-color: #0f9e8f;
            border-color: #0f9e8f;
            transform: translateY(-1px);
        }
        
        .text-center {
            text-align: center !important;
        }
        
        small {
            font-size: 85%;
            font-weight: 400;
        }
        
        a {
            color: #14B8A6;
            text-decoration: none;
        }
        
        a:hover {
            color: #0f9e8f;
            text-decoration: underline;
        }
        
        /* RTL Support */
        [dir="rtl"] .form-check {
            padding-right: 1.5em;
            padding-left: 0;
        }
        
        [dir="rtl"] .input-group:not(.has-validation)>:not(:last-child):not(.dropdown-toggle):not(.dropdown-menu):not(.form-floating) {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            border-top-right-radius: 0.375rem;
            border-bottom-right-radius: 0.375rem;
        }
        
        [dir="rtl"] .input-group>:not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
            margin-right: -1px;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            border-top-left-radius: 0.375rem;
            border-bottom-left-radius: 0.375rem;
        }
        
        [dir="rtl"] .input-group-text:last-child {
            border-right: 0;
        }
        
        /* Responsive adjustments */
        @media (max-width: 576px) {
            .authentication-inner {
                max-width: 340px;
            }
            
            .card-body {
                padding: 1.25rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const passwordToggle = document.querySelector('.input-group-text');
            const passwordInput = document.getElementById('password');
            const passwordIcon = passwordToggle.querySelector('i');
            
            passwordToggle.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    passwordIcon.classList.remove('bx-hide');
                    passwordIcon.classList.add('bx-show');
                } else {
                    passwordInput.type = 'password';
                    passwordIcon.classList.remove('bx-show');
                    passwordIcon.classList.add('bx-hide');
                }
            });
            
            // Form submission loading state
            const form = document.getElementById('formAuthentication');
            const submitButton = form.querySelector('button[type="submit"]');
            
            form.addEventListener('submit', function(e) {
                if (form.checkValidity()) {
                    submitButton.disabled = true;
                    submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> جاري تسجيل الدخول...';
                }
            });
        });
    </script>
    
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</x-guest-layout>