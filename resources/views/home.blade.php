<x-app-layout>
    <div class="bg-gradient-to-b from-blue-50 to-white dark:from-gray-900 dark:to-gray-800" dir="rtl">
        <!-- قسم الترحيب والبحث -->
        <div class="relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
                <div class="text-center">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                        ساهم في صنع التغيير <span class="text-blue-600">مع منصة التطوع</span>
                    </h1>
                    <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto">
                        انضم إلى مجتمع المتطوعين وشارك في الحملات التطوعية أو قدم المساعدة لمن يحتاجها
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('campaigns.index', ['type' => 'volunteer']) }}" class="px-8 py-3 bg-blue-600 text-white font-medium rounded-lg shadow-md hover:bg-blue-700 transition-colors duration-300">
                            استعرض حملات التطوع
                        </a>
                        <a href="{{ route('campaigns.index', ['type' => 'help']) }}" class="px-8 py-3 bg-white text-blue-600 border border-blue-200 font-medium rounded-lg shadow-sm hover:bg-blue-50 transition-colors duration-300">
                            استعرض حملات المساعدة
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- زخارف الخلفية -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 opacity-20">
                <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl"></div>
                <div class="absolute top-1/3 -right-24 w-96 h-96 bg-orange-200 rounded-full mix-blend-multiply filter blur-3xl"></div>
            </div>
        </div>

        <!-- قسم الإحصائيات -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
                    <div class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ rand(50, 200) }}</div>
                    <div class="text-gray-600 dark:text-gray-300 mt-2">حملة تطوعية</div>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
                    <div class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ rand(500, 2000) }}</div>
                    <div class="text-gray-600 dark:text-gray-300 mt-2">متطوع</div>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
                    <div class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ rand(20, 100) }}</div>
                    <div class="text-gray-600 dark:text-gray-300 mt-2">منظمة</div>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
                    <div class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ rand(100, 500) }}K</div>
                    <div class="text-gray-600 dark:text-gray-300 mt-2">ريال تبرعات</div>
                </div>
            </div>
        </div>

        <!-- قسم الحملات المميزة -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">حملات مميزة</h2>
                <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    تعرف على أبرز الحملات التطوعية والمساعدات المتاحة حالياً
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- بطاقة حملة 1 -->
                <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md border border-gray-100 dark:border-gray-700 transition-transform hover:-translate-y-1">
                    <div class="h-48 bg-gray-200 dark:bg-gray-700 relative">
                        <div class="absolute top-3 right-3 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                            حملة تطوع
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">حملة تنظيف الشواطئ</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-2">
                            انضم إلينا في حملة تنظيف شواطئ المدينة والحفاظ على البيئة البحرية
                        </p>
                        <div class="flex justify-between items-center">
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                <span>١٥ مايو ٢٠٢٣</span>
                            </div>
                            <a href="#" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium">
                                التفاصيل &larr;
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- بطاقة حملة 2 -->
                <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md border border-gray-100 dark:border-gray-700 transition-transform hover:-translate-y-1">
                    <div class="h-48 bg-gray-200 dark:bg-gray-700 relative">
                        <div class="absolute top-3 right-3 bg-orange-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                            حملة مساعدة
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">مساعدة المتضررين من السيول</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-2">
                            حملة لجمع التبرعات ومساعدة العائلات المتضررة من السيول في المناطق الجنوبية
                        </p>
                        <div class="flex justify-between items-center">
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                <span>٢٠ أبريل ٢٠٢٣</span>
                            </div>
                            <a href="#" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium">
                                التفاصيل &larr;
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- بطاقة حملة 3 -->
                <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md border border-gray-100 dark:border-gray-700 transition-transform hover:-translate-y-1">
                    <div class="h-48 bg-gray-200 dark:bg-gray-700 relative">
                        <div class="absolute top-3 right-3 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                            حملة تطوع
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">تعليم اللغة العربية للأطفال</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-2">
                            برنامج تطوعي لتعليم اللغة العربية للأطفال في المناطق النائية
                        </p>
                        <div class="flex justify-between items-center">
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                <span>١ يونيو ٢٠٢٣</span>
                            </div>
                            <a href="#" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium">
                                التفاصيل &larr;
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-10">
                <a href="{{ route('campaigns.index') }}" class="inline-flex items-center px-6 py-3 border border-blue-300 text-base font-medium rounded-md text-blue-700 bg-white hover:bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800 dark:hover:bg-gray-700">
                    عرض جميع الحملات
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- قسم كيفية المشاركة -->
                <!-- قسم كيفية المشاركة -->
                <div class="bg-blue-50 dark:bg-gray-900 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">كيف تشارك معنا؟</h2>
                    <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        خطوات بسيطة للمشاركة في الحملات التطوعية أو طلب المساعدة
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border border-gray-100 dark:border-gray-700 text-center">
                        <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">إنشاء حساب</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            قم بإنشاء حساب جديد في المنصة للوصول إلى جميع الخدمات المتاحة
                        </p>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border border-gray-100 dark:border-gray-700 text-center">
                        <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">استعراض الحملات</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            تصفح الحملات المتاحة واختر ما يناسب اهتماماتك ومهاراتك
                        </p>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border border-gray-100 dark:border-gray-700 text-center">
                        <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">المشاركة والتفاعل</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            سجل في الحملة وشارك بوقتك ومهاراتك أو قدم المساعدة المطلوبة
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- قسم قصص النجاح -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">قصص نجاح</h2>
                <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    تعرف على قصص نجاح المتطوعين وتأثيرهم الإيجابي في المجتمع
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- قصة نجاح 1 -->
                <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md border border-gray-100 dark:border-gray-700 flex flex-col md:flex-row">
                    <div class="md:w-1/3 bg-gray-200 dark:bg-gray-700"></div>
                    <div class="p-6 md:w-2/3">
                        <div class="flex items-center mb-4">
                            <div class="h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="mr-3">
                                <h4 class="font-bold text-gray-900 dark:text-white">أحمد محمد</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">متطوع في حملة تشجير الأحياء</p>
                            </div>
                        </div>
                        <blockquote class="text-gray-600 dark:text-gray-300 mb-4">
                            "كانت تجربة التطوع في حملة تشجير الأحياء من أجمل التجارب التي خضتها. ساهمنا في زراعة أكثر من 500 شجرة في حينا، وأصبح المكان أكثر جمالاً وحيوية. أنصح الجميع بالمشاركة في مثل هذه الحملات لما لها من أثر إيجابي على المجتمع والبيئة."
                        </blockquote>
                    </div>
                </div>
                
                <!-- قصة نجاح 2 -->
                <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md border border-gray-100 dark:border-gray-700 flex flex-col md:flex-row">
                    <div class="md:w-1/3 bg-gray-200 dark:bg-gray-700"></div>
                    <div class="p-6 md:w-2/3">
                        <div class="flex items-center mb-4">
                            <div class="h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="mr-3">
                                <h4 class="font-bold text-gray-900 dark:text-white">نورة عبدالله</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">منظمة حملة تعليم الأطفال</p>
                            </div>
                        </div>
                        <blockquote class="text-gray-600 dark:text-gray-300 mb-4">
                            "بدأت حملة تعليم الأطفال بفكرة بسيطة، وبفضل المنصة استطعنا جمع أكثر من 50 متطوعاً للمساعدة في تعليم الأطفال في المناطق النائية. رأينا الفرحة في عيون الأطفال وهم يتعلمون مهارات جديدة، وهذا ما يدفعنا للاستمرار في العمل التطوعي."
                        </blockquote>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-10">
                <a href="#" class="inline-flex items-center px-6 py-3 border border-blue-300 text-base font-medium rounded-md text-blue-700 bg-white hover:bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800 dark:hover:bg-gray-700">
                    المزيد من قصص النجاح
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- قسم انضم إلينا -->
        <div class="bg-blue-600 dark:bg-blue-800 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-white mb-6">انضم إلينا اليوم وكن جزءاً من التغيير</h2>
                    <p class="text-blue-100 mb-8 max-w-3xl mx-auto">
                        سجل الآن في منصة التطوع واستكشف الفرص المتاحة للمساهمة في خدمة المجتمع وصنع الفرق
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        @auth
                            <a href="{{ route('campaigns.index') }}" class="px-8 py-3 bg-white text-blue-600 font-medium rounded-lg shadow-md hover:bg-blue-50 transition-colors duration-300">
                                استعرض الحملات
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-blue-600 font-medium rounded-lg shadow-md hover:bg-blue-50 transition-colors duration-300">
                                سجل الآن
                            </a>
                            <a href="{{ route('login') }}" class="px-8 py-3 bg-blue-700 text-white border border-blue-500 font-medium rounded-lg shadow-md hover:bg-blue-800 transition-colors duration-300">
                                تسجيل الدخول
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>