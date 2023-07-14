@extends('partials.panel.layout')
@section('title', $title)
@section('content')
    <div class="container">

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong>تم!</strong> {{ session()->get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session()->has('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong>خطأ!</strong> {{ session()->get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session()->has('warning'))
            <div class="alert alert-warning alert-dismissible" role="alert">
                <strong>تحذير!</strong> {{ session()->get('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session()->has('info'))
            <div class="alert alert-info alert-dismissible" role="alert">
                <strong>معلومة!</strong> {{ session()->get('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">الاعدادات</h4>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('panel.settings.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name">اسم الموقع</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ old('name', $settings->get('name')) }}">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email">البريد الالكتروني</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        value="{{ old('email', $settings->get('email')) }}">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone">رقم الهاتف</label>
                                    <input type="text" class="form-control" name="phone" id="phone"
                                        value="{{ old('phone', $settings->get('phone')) }}">
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="address">العنوان</label>
                                    <input type="text" class="form-control" name="address" id="address"
                                        value="{{ old('address', $settings->get('address')) }}">
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="facebook">فيسبوك</label>
                                    <input type="text" class="form-control" name="facebook" id="facebook"
                                        value="{{ old('facebook', $settings->get('facebook')) }}">
                                    @error('facebook')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="twitter">تويتر</label>
                                    <input type="text" class="form-control" name="twitter" id="twitter"
                                        value="{{ old('twitter', $settings->get('twitter')) }}">
                                    @error('twitter')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>
                            <button type="submit" class="btn btn-danger">حفظ</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('panel.settings.store') }}" method="POST">
                            @csrf
                            <div class="row">

                                {{-- who we are --}}
                                <div class="col-md-12 mb-3">
                                    <label for="name" class="fs-6 fw-bold">من نحن</label>
                                    <textarea class="form-control" name="who_we_are" rows="5" value="{{ old('who_we_are') }}">{{ $settings->get('who_we_are') }}</textarea>
                                    @error('who_we_are')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="name" class="fs-6 fw-bold">شركة الغد</label>
                                    <textarea class="form-control" name="tomorrow_company" rows="5" value="{{ old('tomorrow_company') }}">{{ $settings->get('tomorrow_company') }}</textarea>
                                    @error('tomorrow_company')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="name" class="fs-6 fw-bold">من نخدم؟</label>
                                    <textarea class="form-control" name="who_do_we_serve" rows="5" value="{{ old('who_do_we_serve') }}">{{ $settings->get('who_do_we_serve') }}</textarea>
                                    @error('who_do_we_serve')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="name" class="fs-6 fw-bold">أهدافنا</label>
                                    <textarea class="form-control" name="our_goals" rows="5" value="{{ old('our_goals') }}">{{ $settings->get('our_goals') }}</textarea>
                                    @error('our_goals')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="name" class="fs-6 fw-bold">شروط إلغاء الخدمة</label>
                                    <textarea class="form-control" name="terms_service_cancellation" rows="5"
                                        value="{{ old('terms_service_cancellation') }}">{{ $settings->get('terms_service_cancellation') }}</textarea>
                                    @error('terms_service_cancellation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="name" class="fs-6 fw-bold">امن الحساب</label>
                                    <textarea class="form-control" name="account_security" rows="5" value="{{ old('account_security') }}">{{ $settings->get('account_security') }}</textarea>
                                    @error('account_security')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="name" class="fs-6 fw-bold">حماية الحقوق</label>
                                    <textarea class="form-control" name="rights_protection" rows="5" value="{{ old('rights_protection') }}">{{ $settings->get('rights_protection') }}</textarea>
                                    @error('rights_protection')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="name" class="fs-6 fw-bold">مراقبة الحجوزات</label>
                                    <textarea class="form-control" name="monitoring_reservations" rows="5"
                                        value="{{ old('monitoring_reservations') }}">{{ $settings->get('monitoring_reservations') }}</textarea>
                                    @error('monitoring_reservations')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <button type="submit" class="btn btn-danger">حفظ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
