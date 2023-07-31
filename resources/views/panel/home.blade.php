@extends('partials.panel.layout')
@section('title', 'الرئيسية')
<link rel="stylesheet" href="{{ asset('assets/css/custom.card.css') }}">

@section('content')

    <section class="mt-md-4 pt-md-2 mb-5 pb-4">

        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Card -->
                <div class="card card-cascade bg-brown-color cascading-admin-card">

                    <!-- Card Data -->
                    <div class="admin-up">
                        <i class="fas fa-users brown-color mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">المستخدمين</p>
                            <h4 class="font-weight-bold dark-grey-text"style="text-align: left;">{{ models_count('users') }}
                            </h4>
                        </div>
                    </div>
                </div>
                <!-- Card -->
            </div>

        </div>

        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Card -->
                <div class="card card-cascade bg-brown-color cascading-admin-card">

                    <!-- Card Data -->
                    <div class="admin-up">
                        <i class="fas fa-bullhorn brown-color mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">الإعلانات</p>
                            <h4 class="font-weight-bold dark-grey-text"style="text-align: left;">{{ models_count('cars') }}
                            </h4>
                        </div>
                    </div>
                </div>
                <!-- Card -->
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Card -->
                <div class="card card-cascade bg-brown-color cascading-admin-card">

                    <!-- Card Data -->
                    <div class="admin-up">
                        <i class="fas fa-bullhorn brown-color mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">الإعلانات المقبولة</p>
                            <h4 class="font-weight-bold dark-grey-text"style="text-align: left;">
                                {{ models_count('cars-approved') }}
                            </h4>
                        </div>
                    </div>
                </div>
                <!-- Card -->
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Card -->
                <div class="card card-cascade bg-brown-color cascading-admin-card">

                    <!-- Card Data -->
                    <div class="admin-up">
                        <i class="fas fa-bullhorn brown-color mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">الإعلانات المرفوضة</p>
                            <h4 class="font-weight-bold dark-grey-text"style="text-align: left;">
                                {{ models_count('cars-rejected') }}
                            </h4>
                        </div>
                    </div>
                </div>
                <!-- Card -->
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Card -->
                <div class="card card-cascade bg-brown-color cascading-admin-card">

                    <!-- Card Data -->
                    <div class="admin-up">
                        <i class="fas fa-bullhorn brown-color mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">الإعلانات الجديدة</p>
                            <h4 class="font-weight-bold dark-grey-text"style="text-align: left;">
                                {{ models_count('cars-new') }}
                            </h4>
                        </div>
                    </div>
                </div>
                <!-- Card -->
            </div>

        </div>

    </section>

@endsection
