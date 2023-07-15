@extends('partials.panel.layout')
@section('title', $title)
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">المميزات الإضافية</h4>
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <label for="basic-url" class="form-label"><strong> عدد الأبواب</strong></label>
                                <div class="input-group mb-3">
                                    <select class="select">
                                        <option value="" selected hidden></option>
                                        @foreach (doors(true) as $name => $id)
                                            <option value="{{ $id }}"
                                            data-mdb-icon="https://mdbootstrap.com/img/Photos/Avatars/avatar-1.jpg"
                                            data-mdb-icon="https://mdbootstrap.com/img/Photos/Avatars/avatar-2.jpg"
                                                class="rounded-circle">{{ __($name) }}</option>
                                        @endforeach
                                    </select>
                                    <label class="form-label select-label" for="basic-url"><strong> عدد الأبواب</strong></label>
                                    <button class="btn btn-sm btn-danger" type="button" id="button-addon1"
                                        data-mdb-ripple-color="dark">
                                        <i class="fas fa-plus "></i>
                                    </button>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="basic-url" class="form-label"><strong> عدد الإسطوانات</strong></label>
                                <div class="input-group mb-3">
                                    <select class="select">
                                        <option></option>
                                        @foreach (cylinders(true) as $name => $id)
                                            <option value="{{ $id }}">{{ __($name) }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-sm btn-danger" type="button" id="button-addon1"
                                        data-mdb-ripple-color="dark">
                                        <i class="fas fa-plus "></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <label for="basic-url" class="form-label"><strong> عدد المقاعد</strong></label>
                                <div class="input-group mb-3">
                                    <select class="select">
                                        <option></option>
                                        @foreach (seats(true) as $name => $id)
                                            <option value="{{ $id }}">{{ __($name) }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-sm btn-danger" type="button" id="button-addon1"
                                        data-mdb-ripple-color="dark">
                                        <i class="fas fa-plus "></i>
                                    </button>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <label for="basic-url" class="form-label"><strong> نوع الجسم</strong></label>
                                <div class="input-group mb-3">
                                    <select class="select">
                                        <option></option>
                                        @foreach (body_types(true) as $name => $id)
                                            <option value="{{ $id }}">{{ __($name) }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-sm btn-danger" type="button" id="button-addon1"
                                        data-mdb-ripple-color="dark">
                                        <i class="fas fa-plus "></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="basic-url" class="form-label"><strong> نوع الوقود</strong></label>
                                <div class="input-group mb-3">
                                    <select class="select">
                                        <option></option>
                                        @foreach (fuel_types(true) as $name => $id)
                                            <option value="{{ $id }}">{{ __($name) }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-sm btn-danger" type="button" id="button-addon1"
                                        data-mdb-ripple-color="dark">
                                        <i class="fas fa-plus "></i>
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="basic-url" class="form-label"><strong> موديل السيارة</strong></label>
                                <div class="input-group mb-3">
                                    <select class="select">
                                        <option></option>
                                        @foreach (car_models(true) as $name => $id)
                                            <option value="{{ $id }}">{{ __($name) }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-sm btn-danger" type="button" id="button-addon1"
                                        data-mdb-ripple-color="dark">
                                        <i class="fas fa-plus "></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="basic-url" class="form-label"><strong> قوة المحرك</strong></label>
                                <div class="input-group mb-3">
                                    <select class="select">
                                        <option></option>
                                        @foreach (engine_powers(true) as $name => $id)
                                            <option value="{{ $id }}">{{ __($name) }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-sm btn-danger" type="button" id="button-addon1"
                                        data-mdb-ripple-color="dark">
                                        <i class="fas fa-plus "></i>
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="basic-url" class="form-label"><strong> نوع الناقل</strong></label>
                                <div class="input-group mb-3">
                                    <select class="select">
                                        <option></option>
                                        @foreach (transmissions(true) as $name => $id)
                                            <option value="{{ $id }}">{{ __($name) }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-sm btn-danger" type="button" id="button-addon1"
                                        data-mdb-ripple-color="dark">
                                        <i class="fas fa-plus "></i>
                                    </button>
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="basic-url" class="form-label"><strong> اللون الداخلي</strong></label>
                                <div class="input-group mb-3">
                                    <select class="select">
                                        <option></option>
                                        @foreach (inner_colors(true) as $name => $id)
                                            <option value="{{ $id }}">{{ __($name) }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-sm btn-danger" type="button" id="button-addon1"
                                        data-mdb-ripple-color="dark">
                                        <i class="fas fa-plus "></i>
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="basic-url" class="form-label"><strong> اللون الخارجي</strong></label>
                                <div class="input-group mb-3">
                                    <select class="select">
                                        <option></option>
                                        @foreach (outer_colors(true) as $name => $id)
                                            <option value="{{ $id }}">{{ __($name) }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-sm btn-danger" type="button" id="button-addon1"
                                        data-mdb-ripple-color="dark">
                                        <i class="fas fa-plus "></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="basic-url" class="form-label"><strong> السنة</strong></label>
                                <div class="input-group mb-3">
                                    <select class="select">
                                        <option></option>
                                        @foreach (years(true) as $name => $id)
                                            <option value="{{ $id }}">{{ __($name) }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-sm btn-danger" type="button" id="button-addon1"
                                        data-mdb-ripple-color="dark">
                                        <i class="fas fa-plus "></i>
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="basic-url" class="form-label"><strong> نوع البائع</strong></label>
                                <div class="input-group mb-3">
                                    <select class="select">
                                        <option></option>
                                        @foreach (seller_types(true) as $name => $id)
                                            <option value="{{ $id }}">{{ __($name) }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-sm btn-danger" type="button" id="button-addon1"
                                        data-mdb-ripple-color="dark">
                                        <i class="fas fa-plus "></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="basic-url" class="form-label"><strong> حالة السيارة
                                        الميكانيكية</strong></label>
                                <div class="input-group mb-3">
                                    <select class="select">
                                        <option></option>
                                        @foreach (mechanical_conditions(true) as $name => $id)
                                            <option value="{{ $id }}">{{ __($name) }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-sm btn-danger" type="button" id="button-addon1"
                                        data-mdb-ripple-color="dark">
                                        <i class="fas fa-plus "></i>
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="basic-url" class="form-label"><strong> المواصفات الإقليمية</strong></label>
                                <div class="input-group mb-3">
                                    <select class="select">
                                        <option></option>
                                        @foreach (regional_specifications(true) as $name => $id)
                                            <option value="{{ $id }}">{{ __($name) }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-sm btn-danger" type="button" id="button-addon1"
                                        data-mdb-ripple-color="dark">
                                        <i class="fas fa-plus "></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="basic-url" class="form-label"><strong> حالة السيارة</strong></label>
                                <div class="input-group mb-3">
                                    <select class="select">
                                        <option></option>
                                        @foreach (car_conditions(true) as $name => $id)
                                            <option value="{{ $id }}">{{ __($name) }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-sm btn-danger" type="button" id="button-addon1"
                                        data-mdb-ripple-color="dark">
                                        <i class="fas fa-plus "></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
