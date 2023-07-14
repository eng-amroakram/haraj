<section class="mb-4" wire:ignore.self style="height:650px;">

    {{-- alert success, info, error, warning --}}

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>{{ session('info') }}</strong>
            <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('warning') }}</strong>
            <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card"
        style="--mdb-card-box-shadow: 0 2px 15px -3px rgb(0, 0, 0), 0 10px 20px -2px rgba(0, 0, 0, 0.04);">

        <div class="card-header py-0">
            <nav class="navbar-expand-lg navbar-light bg-light mt-3"
                style="--mdb-navbar-box-shadow: 0 4px 12px 0 rgb(189, 189, 189),0 2px 4px rgba(0,0,0,0.05);">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"
                                    class="text-dark fw-bold fs-6">الصفحة
                                    الرئيسية</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="#"
                                    class="text-dark  fs-6">{{ $table_name }}</a></li>
                        </ol>
                    </nav>
                </div>
            </nav>
        </div>

        <div class="card-body">

            <div id="customremoveinputgroup" class="input-group p-0 mb-3" wire:ignore>
                <!-- search input -->
                <div id="navbar-search-autocomplete" class="form-outline">
                    <input type="search" id="form1" wire:model="search" class="form-control" />
                    <label class="form-label" for="form1">البحث</label>
                </div>

                @foreach ($selects as $name => $options)
                    <x-table-extension.select :input="$name" :options="$options"></x-table-extension.select>
                @endforeach

                {{--
                <div id="customwidth">
                    <button class="btn dropdown-toggle text-white fs-6" style="background-color: #b95353;"
                        type="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        تصدير
                    </button>

                    <ul class="dropdown-menu text-center fs-6">
                        <li>
                            <a class="dropdown-item fw-bold" href="#">
                                <i class="fas fa-file-excel text-success fs-5"></i>
                                ملف اكسل
                            </a>
                        </li>
                    </ul>
                </div> --}}
                <!-- mb-2 -->

            </div>


            <div class="table-responsive">

                <x-table-extension.loading></x-table-extension.loading>

                <table class="table table-hover text-nowrap table-bordered text-center">
                    <thead>
                        <tr>
                            {{-- <th scope="col">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            </th> --}}
                            @foreach ($columns as $column)
                                <th scope="col">{{ $column }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $model)
                            <x-table-extension.rows :model="$model" :page="$create['page']" :updaterid="$updater_id"
                                :table="$table" :rows="$rows">
                            </x-table-extension.rows>
                        @endforeach
                    </tbody>

                </table>
            </div>

            @if ($create['check'])

                @if ($create['page'])
                    <div class="d-flex justify-content-end mt-3">
                        <a type="button" class="btn btn-rounded create-button"
                            href="{{ route('panel.users.create') }}">
                            <i class="fas fa-plus"></i>
                            {{ $create['lable'] }}
                        </a>
                    </div>
                @endif

                @if ($create['modal'])
                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-rounded create-button" data-mdb-toggle="modal"
                            data-mdb-ripple-color="dark" data-mdb-target="#{{ $create['id'] }}">
                            <i class="fas fa-plus"></i>
                            {{ $create['lable'] }}
                        </button>
                    </div>
                @endif

            @endif

        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between">

                <div wire:ignore>
                    <select class="select" wire:model="rows_number">
                        <option value="5" selected>5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <label class="form-label select-label">الصفوف</label>
                </div>

                <div>
                    <nav aria-label="...">
                        <ul class="pagination pagination-circle">
                            {{ $data->withQueryString()->onEachSide(0)->links() }}
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </div>
    @livewire('creator', ['service' => $table])
    @livewire('updater', ['service' => $table])
</section>




@push('table_scripts')
    <script>
        $(document).ready(function() {

            //Fields Decleration
            var $checkboxInputTable = $(".checkboxInputTable");
            var $textInputTable = $(".textInputTable");
            var $selectInputTable = $(".selectInputTable");

            //Collection Array
            var $data = [];


            function setDataTable(key, value) {
                $data[key] = value;
            }

            function getContentTable() {
                var $object = Object.assign({}, $data);
                return JSON.stringify($object);
            }

            //Fields Actions
            $textInputTable.on("input", function() {
                let $value = $(this).val();
                let $name = $(this).attr('name');
                setDataTable($name, $value);
            });


            $checkboxInputTable.on('change', function() {
                let $value = $(this).val();
                let $name = $(this).attr('name');
                let $checked = $(this).is(':checked');

                if ($checked) {
                    $(this).prop('checked', true);
                    $data[$name] = true;
                    setDataTable($name, true);
                } else {
                    $data[$name] = false;
                    setDataTable($name, false);
                    $(this).prop('checked', false);
                }
            });

            $selectInputTable.on('change', function() {
                let $value = $(this).val();
                let $name = $(this).attr('name');
                setDataTable($name, $value);
            });

            $(".changeStatusCar").on('click', function() {
                console.log('clicked');
            });


        });
    </script>
@endpush
