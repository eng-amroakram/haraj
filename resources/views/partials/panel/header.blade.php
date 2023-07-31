<header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">

        <a class="ripple d-flex justify-content-center py-2" href="#!" data-ripple-color="primary">
            <img id="MDB-logo" src="{{ asset('assets/images/vertical/logo.png') }}" width="150" alt="MDB Logo"
                draggable="false">
        </a>

        <div class="position-sticky scrollable-nav">
            <div class="list-group list-group-flush mx-3 mt-4">

                <a href="{{ route('panel.home') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.home' ? ' active' : '' }}"
                    aria-current="true">
                    <i class="fas fa-tachometer-alt fa-fw me-3"></i>
                    <span>الصفحة الرئيسية</span>
                </a>

                <a href="#features">

                    <a class="list-group-item list-group-item-action py-2 ripple" data-toggle="collapse"
                        href="#features" role="button" aria-expanded="false" tabindex="1">
                        <i class="fas fa-address-book pr-3"></i>
                        المميزات
                        <i class="fas fa-angle-down rotate-icon" style="transform: rotate(0deg);"></i>
                    </a>

                    <ul class="sidenav-collapse collapse {{ in_array(Route::currentRouteName(), config('data.routes')) ? 'show' : '' }}"
                        style="list-style: none; padding: 0; margin: 0;" id="features">
                        <li>
                            <a href="{{ route('panel.features.doors') }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.features.doors' ? ' active' : '' }}">
                                <i class="fas fa-person-hiking"></i>
                                <span>عدد الأبواب</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('panel.features.cylinders') }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.features.cylinders' ? ' active' : '' }}">
                                <i class="fas fa-circle-notch"></i>
                                <span>عدد الإسطوانات</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('panel.features.seats') }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.features.seats' ? ' active' : '' }}">
                                <i class="fas fa-chair"></i>
                                <span>عدد المقاعد</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.features.body-types') }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.features.body-types' ? ' active' : '' }}">
                                <i class="fas fa-car-side"></i>
                                <span>نوع الجسم</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.features.fuel-types') }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.features.fuel-types' ? ' active' : '' }}">
                                <i class="fas fa-gas-pump"></i>
                                <span>نوع الوقود</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.features.car-models') }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.features.car-models' ? ' active' : '' }}">
                                <i class="fas fa-car"></i>
                                <span>موديل السيارة</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.features.engine-powers') }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.features.engine-powers' ? ' active' : '' }}">
                                <i class="fas fa-dumbbell"></i>
                                <span>قوة المحرك</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.features.transmissions') }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.features.transmissions' ? ' active' : '' }}">
                                <i class="fas fa-transgender"></i>
                                <span>نوع الناقل</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.features.inner-colors') }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.features.inner-colors' ? ' active' : '' }}">
                                <i class="fas fa-palette"></i>
                                <span>اللون الداخلي</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.features.outer-colors') }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.features.outer-colors' ? ' active' : '' }}">
                                <i class="fas fa-palette"></i>
                                <span>اللون الخارجي</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.features.seller-types') }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.features.seller-types' ? ' active' : '' }}">
                                <i class="fas fa-users-gear"></i>
                                <span>نوع البائع</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.features.years') }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.features.years' ? ' active' : '' }}">
                                <i class="fas fa-calendar-check"></i>
                                <span>السنة</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.features.mechanical-conditions') }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.features.mechanical-conditions' ? ' active' : '' }}">
                                <i class="fas fa-calendar-check"></i>
                                <span>الحالة الميكانيكية</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.features.regional-specifications') }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.features.regional-specifications' ? ' active' : '' }}">
                                <i class="fas fa-calendar-check"></i>
                                <span>المواصفات الإقليمية</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.features.car-conditions') }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.features.car-conditions' ? ' active' : '' }}">
                                <i class="fas fa-calendar-check"></i>
                                <span>حالةالسيارة</span>
                            </a>
                        </li>

                    </ul>

                </a>


                <a href="{{ route('panel.users.index') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.users.index' ? ' active' : '' }}">
                    <i class="fas fa-user-gear"></i>
                    <span>المستخدمين</span>
                </a>

                <a href="{{ route('panel.cars.index') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.cars.index' ? ' active' : '' }}">
                    <i class="fas fa-bullhorn"></i>
                    <span>الإعلانات</span>
                </a>

                <a href="{{ route('panel.offers.index') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.offers.index' ? ' active' : '' }}">
                    <i class="fas fa-earth-oceania"></i>
                    <span>العروض</span>
                </a>

                <a href="{{ route('panel.cities.index') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.cities.index' ? ' active' : '' }}">
                    <i class="fas fa-earth-oceania"></i>
                    <span>المدن</span>
                </a>

                <a href="{{ route('panel.princedoms.index') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.princedoms.index' ? ' active' : '' }}">
                    <i class="fas fa-earth-oceania"></i>
                    <span>المناطق</span>
                </a>

                <a href="{{ route('panel.settings.index') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.settings.index' ? ' active' : '' }}">
                    <i class="fas fa-gear"></i>
                    <span>الاعدادات</span>
                </a>

            </div>
        </div>
    </nav>

    <!-- Sidebar -->

    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <!-- Container wrapper -->
        <div class="container">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
                aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Brand -->
            <a class="navbar-brand" href="#">
                <!-- <img src="images/logo.png" height="25" alt="MDB Logo" loading="lazy" /> -->
            </a>

            <div class="d-flex align-items-center">
                <div class="dropdown">

                    <a class="text-reset me-3 dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-mdb-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li class="logout">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-arrow-right-from-bracket text-danger"></i>
                                <span class="ms-1">تسجيل الخروج</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
</header>
