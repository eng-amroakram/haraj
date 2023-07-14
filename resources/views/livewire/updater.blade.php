<div class="modal fade" id="{{ $updater_id }}" tabindex="-1" role="dialog" data-mdb-backdrop="static"
    aria-labelledby="updater" aria-hidden="true" wire:ignore>
    <div class="modal-dialog {{ $size }} cascading-modal" style="margin-top: 4%">

        <div class="modal-content">

            <div class="modal-c-tabs">
                <x-updater.nav-tabs :tabs="$tabs" :title="$title"></x-updater.nav-tabs>

                <div class="tab-content">

                    <x-table-extension.loading></x-table-extension.loading>

                    @foreach ($contents as $content)
                        <x-updater.tab-content :content="$content" :size="$size" :updaterbuttong="'submitUpdater'" :updaterid="$updater_id">
                        </x-updater.tab-content>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>

@push('updater')
    <script>
        $(document).ready(function() {

            $(".password_input_id_updater_div").hide();

            //Buttons
            var $submitUpdater = $(".submitUpdater");

            //Inputs
            var $inputTextUpdater = $(".inputTextUpdater");
            var $inputSelectUpdater = $(".inputSelectUpdater");
            var $checkboxInputUpdater = $(".checkboxInputUpdater");

            //Next
            var $nextUpdater = $(".nextUpdater");

            //Tabs
            var $nav_tabs_custom_updater = $(".nav-tabs-custom-updater");
            var $nav_link_custom_updater = $(".nav-link-custom-updater");

            var $data_updater = [];

            function setInputUpdater($name, $value) {
                $data_updater[$name] = $value;
            }

            function getContentUpdater() {
                var $object = Object.assign({}, $data_updater);
                return JSON.stringify($object);
            }

            function numbers($name, $value) {

                if ($value) {

                    if (typeof $value == 'string') {
                        let string_number = $value.replace(/[^\d.]/g, "");

                        if (string_number.match(/\./g)) {
                            if (string_number.match(/\./g).length > 1) {
                                string_number = string_number.replace(/,/g, "").replace(/\.(?=.*\.)/g,
                                    "");
                            }
                        }

                        let number = parseFloat(string_number.replace(/,/g, ""));
                        return number;
                    }
                    return $value;
                }

            }

            $nextUpdater.on('click', function() {
                let $id = $(this).attr('tapupdaterid');

                if ($id) {
                    let $tab = '.' + $id + '-' + 'updater-tap';
                    let $nav = '.' + $id + '-' + 'updater-nav';

                    $nav_link_custom_updater.removeClass('active');
                    $nav_tabs_custom_updater.removeClass('active');
                    $nav_tabs_custom_updater.removeClass('show');

                    $($nav).addClass('active');
                    $($tab).addClass('active');
                    $($tab).addClass('show');
                }

            });

            $inputTextUpdater.on("input", function() {
                $name = $(this).attr("name");
                $value = $(this).val();
                setInputUpdater($name, $value);
            });

            $inputSelectUpdater.on("change", function() {
                $name = $(this).attr("name");
                $value = $(this).val();
                setInputUpdater($name, $value);
            });

            $checkboxInputUpdater.on('change', function() {
                let $value = $(this).val();
                let $name = $(this).attr('name');
                let $checked = $(this).is(':checked');

                if ($checked) {
                    $(this).prop('checked', true);
                    setInputUpdater($name, true);
                } else {
                    $(this).prop('checked', false);
                    setInputUpdater($name, false);
                }
            });

            $submitUpdater.on('click', function() {
                $(".reset-validation").text(" ");

                for (let key in $data_updater) {
                    if ($data_updater.hasOwnProperty(key)) {
                        @this.set(key, $data_updater[key]);
                    }
                }

                Livewire.emit('update', getContentUpdater());
            });

            Livewire.on("updateErrors", function(errors) {
                $(".reset").text("");
                for (let key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        $("." + key + "-validation").text(errors[key]);
                    }
                }
                console.log(errors);
            });

            Livewire.on("closeModal", function(check) {
                let $id = "#{{ $updater_id }}";
                $($id).modal('hide');
                $($id).removeClass('show');
                $($id).attr('aria-hidden', 'true');
                $($id).attr('aria-modal', 'false');
                $($id).css('display', 'none');
                $('body').removeClass('modal-open').css({
                    'overflow': '',
                    'padding-right': ''
                });
                // remove div of class modal-backdrop
                $('.modal-backdrop').remove();
                $(".reset-validation").val("");
                $data_updater = [];
            });

            Livewire.on('select2Updater', function(id_input, value) {
                let $te = value + '';

                if ($te != 'null' && $te) {
                    let singleSelect = document.querySelector(id_input);
                    let singleSelectInstance = mdb.Select.getInstance(singleSelect);
                    singleSelectInstance.setValue($te);
                }
            });

            Livewire.on('setSelectInputUpdater', function(data, inputid, id) {
                var $input = $("#" + inputid);
                var singleSelect = document.querySelector("#" + inputid);
                var singleSelectInstance = mdb.Select.getInstance(singleSelect);

                $.each(data, function(index, value) {
                    if (value == id) {
                        console.log(value, id);

                        $input.append('<option selected value="' + value +
                            '">' +
                            index +
                            '</option>');
                    } else {
                        $input.append('<option value="' + value +
                            '">' +
                            index +
                            '</option>');
                    }

                    $input.append('<option value="' + value + '">' + index + '</option>');
                });

            });

            Livewire.on("setMultiSelectInput", function(inputid, ids) {
                const multiSelect = document.querySelector("#" + inputid);
                const multiSelectInstance = mdb.Select.getInstance(multiSelect);
                multiSelectInstance.setValue(ids);
            });


            Livewire.on('setDataFields', function(data) {
                $data_updater = JSON.parse(data);
                console.log($data_updater);
            });



        });
    </script>
@endpush

</div>
