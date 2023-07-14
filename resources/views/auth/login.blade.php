<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Haraj - Admin Login</title>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mdb.rtl.min.css') }}">
    @livewireStyles()
</head>

<body>
    <section class="gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="{{ asset('assets/images/horizontal/logo.png') }}"
                                            style="width: 300px;" alt="logo">
                                        {{-- <h4 class="mt-1 mb-5 pb-1">حراج اون لاين</h4> --}}
                                    </div>

                                    @livewire('auth', ['is_auth' => true])

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">منصة حراج اون لاين</h4>
                                    <p class="small mb-1">
                                        منصة حراج Haraj هي منصة لبيع السيارات بين العملاء، حيث يتمكن البائعون من وضع
                                        إعلاناتهم والتواصل مع المشترين لإتمام عملية الشراء. تهدف المنصة إلى تسهيل عملية
                                        بيع وشراء السيارات وتوفير بيئة آمنة وموثوقة للمستخدمين.
                                    </p>

                                    <p class="small mb-1">
                                        باستخدام منصة Haraj، يمكن للبائعين إنشاء حسابات ونشر إعلاناتهم لعرض السيارات
                                        المعروضة للبيع. يمكنهم تقديم تفاصيل السيارة مثل الماركة والموديل والسعر والحالة
                                        والصور، مما يساعد المشترين على الاطلاع على المعلومات اللازمة لاتخاذ قرار الشراء.
                                    </p>

                                    <p class="small mb-1">
                                        من جانبهم، يمكن للمشترين تصفح الإعلانات المتاحة والتواصل مع البائعين المهتمين.
                                        يتمكنون من طرح الأسئلة والاستفسارات حول السيارة وترتيب زيارة للاطلاع عليها
                                        وإجراء اتفاقيات الشراء.
                                    </p>

                                    <p class="small mb-0">
                                        من خلال توفير بيئة موثوقة وسهلة الاستخدام، تهدف منصة Haraj إلى تسهيل عملية بيع
                                        وشراء السيارات وتوفير تجربة إيجابية للمستخدمين.
                                    </p>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-livewire-alert::scripts />
    @livewireScripts()
    @stack('login')
</body>

</html>
