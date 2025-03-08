<x-guest-layout>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- نسيت كلمة المرور -->
                <div class="card">
                    <div class="card-body">
                        <!-- الشعار -->
                        <div class="app-brand justify-content-center">
                            <a href="{{ route('home') }}" class="app-brand-link gap-2">
                                <span class="app-brand-text demo text-body fw-bolder">منصة التطوع</span>
                            </a>
                        </div>
                        <!-- /الشعار -->
                        <h4 class="mb-2">نسيت كلمة المرور؟ 🔒</h4>
                        <p class="mb-4">أدخل بريدك الإلكتروني وسنرسل لك تعليمات لإعادة تعيين كلمة المرور</p>

                        <!-- رسالة الحالة -->
                        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('نسيت كلمة المرور؟ لا مشكلة. فقط أخبرنا بعنوان بريدك الإلكتروني وسنرسل لك رابط إعادة تعيين كلمة المرور الذي سيسمح لك باختيار كلمة مرور جديدة.') }}
                        </div>

                        <!-- رسالة النجاح -->
                        @if (session('status'))
                            <div class="alert alert-success mb-3">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">البريد الإلكتروني</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    placeholder="أدخل بريدك الإلكتروني"
                                    value="{{ old('email') }}"
                                    autofocus
                                    required
                                />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <button class="btn btn-primary d-grid w-100">إرسال رابط إعادة التعيين</button>
                        </form>
                        <div class="text-center">
                            <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                                <i class="bx bx-chevron-right scaleX-n1-rtl bx-sm"></i>
                                العودة لتسجيل الدخول
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /نسيت كلمة المرور -->
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
        
        .d-flex {
            display: flex !important;
        }
        
        .d-grid {
            display: grid !important;
        }
        
        .w-100 {
            width: 100% !important;
        }
        
        .alert {
            position: relative;
            padding: 0.875rem 0.875rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.375rem;
        }
        
        .alert-success {
            color: #0d6832;
            background-color: #d1f0d9;
            border-color: #bfe8c7;
        }
        
        /* RTL Support */
        [dir="rtl"] .scaleX-n1-rtl {
            transform: scaleX(-1);
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
    
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</x-guest-layout>