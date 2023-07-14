<header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">

        <a class="ripple d-flex justify-content-center py-2" href="#!" data-ripple-color="primary">
            <img id="MDB-logo" src="{{ asset('assets/images/vertical/logo.png') }}" width="150" alt="MDB Logo"
                draggable="false">
        </a>

        <div class="position-sticky">
            <div class="list-group list-group-flush mx-3 mt-4">

                <a href="{{ route('panel.home') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.home' ? ' active' : '' }}"
                    aria-current="true">
                    <i class="fas fa-tachometer-alt fa-fw me-3"></i>
                    <span>الصفحة الرئيسية</span>
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

                {{--
                <a href="{{ route('panel.neighborhoods') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.neighborhoods' ? ' active' : '' }}">
                    <i class="fas fa-boxes-stacked"></i>

                    <span>الاحياء</span>
                </a>

                <a href="{{ route('panel.clients') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.clients' ? ' active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>العملاء</span>
                </a>

                <a href="{{ route('panel.brokers') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.brokers' ? ' active' : '' }}">
                    <i class="fas fa-people-arrows"></i>
                    <span>الوسطاء</span>
                </a>

                <a href="{{ route('panel.offers') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.offers' ? ' active' : '' }}">
                    <i class="fas fa-globe fa-fw"></i>
                    <span>العروض</span>
                </a>

                <a href="{{ route('panel.orders') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.orders' ? ' active' : '' }}">
                    <i class="fas fa-building fa-fw"></i>
                    <span>الطلبات</span>
                </a>

                <a href="#"
                    class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.reservations' ? ' active' : '' }}">
                    <i class="far fa-address-book"></i>
                    <span>الحجوزات</span>
                </a>

                <a href="#"
                    class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.sales' ? ' active' : '' }}">
                    <i class="fas fa-cart-shopping"></i>
                    <span>المبيعات</span>
                </a> --}}

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
