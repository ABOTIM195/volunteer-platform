<!DOCTYPE html>
<html
  lang="{{ app()->getLocale() }}"
  class="light-style layout-menu-fixed"
  dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets/') }}"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'لوحة التحكم') - منصة التطوع</title>

    <meta name="description" content="منصة التطوع - نظام إدارة المتطوعين والفرص التطوعية" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- RTL styles -->
    @if(app()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl.css') }}" />
    @endif

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->
    @stack('styles')

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!-- Template customizer & Theme config files -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    
    <style>
      body {
        font-family: 'Almarai', 'Public Sans', sans-serif;
      }
    </style>
  </head>

  <body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
              <span class="app-brand-logo demo">
                <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <defs>
                    <path d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z" id="path-1"></path>
                    <path d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z" id="path-3"></path>
                    <path d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z" id="path-4"></path>
                    <path d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z" id="path-5"></path>
                  </defs>
                  <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                      <g id="Icon" transform="translate(27.000000, 15.000000)">
                        <g id="Mask" transform="translate(0.000000, 8.000000)">
                          <mask id="mask-2" fill="white">
                            <use xlink:href="#path-1"></use>
                          </mask>
                          <use fill="#696cff" xlink:href="#path-1"></use>
                          <g id="Path-3" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-3"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                          </g>
                          <g id="Path-4" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-4"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                          </g>
                        </g>
                        <g id="Triangle" transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                          <use fill="#696cff" xlink:href="#path-5"></use>
                          <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                        </g>
                      </g>
                    </g>
                  </g>
                </svg>
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2">منصة التطوع</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- لوحة التحكم -->
            <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
              <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>لوحة التحكم</div>
              </a>
            </li>

            <!-- المتطوعين -->
            <li class="menu-item {{ request()->routeIs('admin.volunteers.*') ? 'active open' : '' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div>المتطوعين</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.volunteers.index') ? 'active' : '' }}">
                  <a href="{{ route('admin.volunteers.index') }}" class="menu-link">
                    <div>قائمة المتطوعين</div>
                  </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.volunteers.create') ? 'active' : '' }}">
                  <a href="{{ route('admin.volunteers.create') }}" class="menu-link">
                    <div>إضافة متطوع</div>
                  </a>
                </li>
              </ul>
            </li>

            <!-- المنظمات -->
            <li class="menu-item {{ request()->routeIs('admin.organizations.*') ? 'active open' : '' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-building"></i>
                <div>المنظمات</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.organizations.index') ? 'active' : '' }}">
                  <a href="{{ route('admin.organizations.index') }}" class="menu-link">
                    <div>قائمة المنظمات</div>
                  </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.organizations.create') ? 'active' : '' }}">
                  <a href="{{ route('admin.organizations.create') }}" class="menu-link">
                    <div>إضافة منظمة</div>
                  </a>
                </li>
              </ul>
            </li>

            <!-- الفرص التطوعية -->
            <li class="menu-item {{ request()->routeIs('admin.campaigns.*') ? 'active open' : '' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-calendar-event"></i>
                <div>الفرص التطوعية</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.campaigns.index') ? 'active' : '' }}">
                  <a href="{{ route('admin.campaigns.index') }}" class="menu-link">
                    <div>قائمة الفرص</div>
                  </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.campaigns.create') ? 'active' : '' }}">
                  <a href="{{ route('admin.campaigns.create') }}" class="menu-link">
                    <div>إضافة فرصة</div>
                  </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                  <a href="{{ route('admin.categories.index') }}" class="menu-link">
                    <div>التصنيفات</div>
                  </a>
                </li>
              </ul>
            </li>

            <!-- طلبات التطوع -->
            <li class="menu-item {{ request()->routeIs('admin.participation-requests.*') ? 'active open' : '' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div>طلبات التطوع</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.participation-requests.index') && request('status') != 'approved' && request('status') != 'rejected' ? 'active' : '' }}">
                  <a href="{{ route('admin.participation-requests.index') }}" class="menu-link">
                    <div>جميع الطلبات</div>
                  </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.participation-requests.index') && request('status') == 'approved' ? 'active' : '' }}">
                  <a href="{{ route('admin.participation-requests.index', ['status' => 'approved']) }}" class="menu-link">
                    <div>الطلبات المقبولة</div>
                  </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.participation-requests.index') && request('status') == 'rejected' ? 'active' : '' }}">
                  <a href="{{ route('admin.participation-requests.index', ['status' => 'rejected']) }}" class="menu-link">
                    <div>الطلبات المرفوضة</div>
                  </a>
                </li>
              </ul>
            </li>

            <!-- الإعدادات -->
            <li class="menu-item {{ request()->routeIs('admin.settings.*') ? 'active open' : '' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div>الإعدادات</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.settings.general') ? 'active' : '' }}">
                  <a href="{{ route('admin.settings.general') }}" class="menu-link">
                    <div>الإعدادات العامة</div>
                  </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.settings.appearance') ? 'active' : '' }}">
                  <a href="{{ route('admin.settings.appearance') }}" class="menu-link">
                    <div>مظهر الموقع</div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="بحث..."
                    aria-label="بحث..."
                  />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- اللغة -->
                <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="fi fi-sa fis rounded-circle fs-3 me-1"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item {{ app()->getLocale() == 'ar' ? 'active' : '' }}" href="{{ route('language.switch', 'ar') }}">
                        <i class="fi fi-sa fis rounded-circle fs-4 me-1"></i>
                        <span class="align-middle">العربية</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}" href="{{ route('language.switch', 'en') }}">
                        <i class="fi fi-us fis rounded-circle fs-4 me-1"></i>
                        <span class="align-middle">English</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!-- /اللغة -->

                <!-- الإشعارات -->
                <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    <i class="bx bx-bell bx-sm"></i>
                    <span class="badge bg-danger rounded-pill badge-notifications">{{ auth()->user()->unreadNotifications->count() }}</span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end py-0">
                    <li class="dropdown-menu-header border-bottom">
                      <div class="dropdown-header d-flex align-items-center py-3">
                        <h5 class="text-body mb-0 me-auto">الإشعارات</h5>
                        <a href="{{ route('admin.notifications.mark-all-as-read') }}" class="dropdown-notifications-all text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="تعيين الكل كمقروء">
                          <i class="bx fs-4 bx-envelope-open"></i>
                        </a>
                      </div>
                    </li>
                    <li class="dropdown-notifications-list scrollable-container">
                      <ul class="list-group list-group-flush">
                        @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                        <li class="list-group-item list-group-item-action dropdown-notifications-item">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar">
                                <span class="avatar-initial rounded-circle bg-label-primary">
                                  <i class="bx bx-{{ $notification->data['icon'] ?? 'bell' }}"></i>
                                </span>
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <h6 class="mb-1">{{ $notification->data['title'] ?? 'إشعار جديد' }}</h6>
                              <p class="mb-0">{{ $notification->data['message'] ?? '' }}</p>
                              <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="{{ route('admin.notifications.mark-as-read', $notification->id) }}" class="dropdown-notifications-read">
                                <span class="badge badge-dot"></span>
                              </a>
                            </div>
                          </div>
                        </li>
                        @empty
                        <li class="list-group-item list-group-item-action dropdown-notifications-item text-center">
                          <p class="mb-0">لا توجد إشعارات جديدة</p>
                        </li>
                        @endforelse
                      </ul>
                    </li>
                    <li class="dropdown-menu-footer border-top">
                      <a href="{{ route('admin.notifications.index') }}" class="dropdown-item d-flex justify-content-center p-3">
                        عرض جميع الإشعارات
                      </a>
                    </li>
                  </ul>
                </li>
                <!-- /الإشعارات -->

                <!-- المستخدم -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      @if(auth()->user()->profile_photo_path)
                      <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt class="w-px-40 h-auto rounded-circle" />
                      @else
                      <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                      @endif
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="{{ route('admin.profile.show') }}">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              @if(auth()->user()->profile_photo_path)
                              <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt class="w-px-40 h-auto rounded-circle" />
                              @else
                              <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                              @endif
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{ auth()->user()->name }}</span>
                            <small class="text-muted">{{ auth()->user()->role == 'admin' ? 'مدير النظام' : 'مشرف' }}</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('admin.profile.show') }}">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">الملف الشخصي</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('admin.settings.general') }}">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">الإعدادات</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">تسجيل الخروج</span>
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                      </form>
                    </li>
                  </ul>
                </li>
                <!-- /المستخدم -->
              </ul>
            </div>
          </nav>
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            @yield('content')
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  ، تم التطوير بواسطة
                  <a href="{{ route('home') }}" target="_blank" class="footer-link fw-bolder">منصة التطوع</a>
                </div>
                <div>
                  <a href="{{ route('privacy-policy') }}" class="footer-link me-4" target="_blank">سياسة الخصوصية</a>
                  <a href="{{ route('terms-of-service') }}" target="_blank" class="footer-link me-4">شروط الاستخدام</a>
                  <a href="{{ route('contact-us') }}" target="_blank" class="footer-link">اتصل بنا</a>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    @stack('scripts')
    
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>