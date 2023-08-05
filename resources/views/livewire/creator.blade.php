<div class="modal top fade" id="{{ $creator_id }}" tabindex="-1" data-mdb-backdrop="static" aria-labelledby="Creator"
    aria-hidden="true" wire:ignore>
    <div class="modal-dialog {{ $size }} cascading-modal" style="margin-top: 4%">

        <div class="modal-content">

            <div class="modal-c-tabs">

                <x-creator.nav-tabs :tabs="$tabs"></x-creator.nav-tabs>

                <div class="tab-content">
                    <x-table-extension.loading></x-table-extension.loading>

                    @foreach ($contents as $content)
                        <x-creator.tab-content :content="$content" :size="$size" :creatorbuttong="'submitCreator'" :creatorid="$creator_id">
                        </x-creator.tab-content>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    @push('creator')
        <script>
            $(document).ready(function() {

                //Buttons
                var $submitCreator = $(".submitCreator");

                //Inputs
                var $inputTextCreator = $(".inputTextCreator");
                var $inputSelectCreator = $(".inputSelectCreator");
                var $checkboxInputCreator = $(".checkboxInputCreator");
                //Next
                var $nextCreator = $(".nextCreator");

                //Tabs
                var $nav_tabs_custom_creator = $(".nav-tabs-custom-creator");
                var $nav_link_custom_creator = $(".nav-link-custom-creator");


                $nextCreator.on('click', function() {
                    let $id = $(this).attr('tapcreatorid');

                    if ($id) {
                        let $tab = '.' + $id + '-' + 'creator-tap';
                        let $nav = '.' + $id + '-' + 'creator-nav';

                        $nav_link_custom_creator.removeClass('active');
                        $nav_tabs_custom_creator.removeClass('active');
                        $nav_tabs_custom_creator.removeClass('show');

                        $($nav).addClass('active');
                        $($tab).addClass('active');
                        $($tab).addClass('show');
                    }

                });

                //Data
                var $data = [];

                //Functions
                function setInput($name, $value) {
                    $data[$name] = $value;
                }

                function getContent() {
                    var $object = Object.assign({}, $data);
                    return JSON.stringify($object);
                }

                function numbers($name, $value) {

                    if ($value) {

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

                    return 0;

                }

                //Events
                $inputTextCreator.on("input", function() {
                    let $name = $(this).attr("name");
                    let $value = $(this).val();
                    setInput($name, $value);
                });

                $inputSelectCreator.on("change", function() {
                    let $name = $(this).attr("name");
                    let $value = $(this).val();
                    setInput($name, $value);
                });

                $checkboxInputCreator.on('change', function() {
                    let $value = $(this).val();
                    let $name = $(this).attr('name');
                    let $checked = $(this).is(':checked');

                    if ($checked) {
                        $(this).prop('checked', true);
                        setInput($name, true);
                    } else {
                        setInput($name, false);
                        $(this).prop('checked', false);
                    }
                });

                $submitCreator.on('click', function() {
                    $(".reset-validation").text(" ");
                    for (let key in $data) {
                        if ($data.hasOwnProperty(key)) {
                            if (key != "main_image" || key != "images") {} else {
                                @this.set(key, $data[key]);
                            }
                        }
                    }
                    Livewire.emit('store', getContent());
                });

                Livewire.on("creator-errors", function(errors) {
                    $(".reset").text("");
                    for (let key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            $("." + key + "-validation").text(errors[key]);
                        }
                    }

                    console.log(errors);
                });

                Livewire.on("closeModal", function(check) {
                    let $id = "#{{ $creator_id }}";
                    $($id).modal('hide');
                    $(".reset-validation").val("");
                    $data = [];
                });

                Livewire.on('select2Creator', function(id, value) {
                    let $te = value + '';
                    if ($te != 'null' && $te) {
                        const singleSelect = document.querySelector(id);
                        const singleSelectInstance = mdb.Select.getInstance(singleSelect);
                        singleSelectInstance.setValue($te);
                        console.log($te);
                    }
                });

                Livewire.on('setSelectInputCreator', function(data, inputid) {
                    var $input = $("#" + inputid);
                    var singleSelect = document.querySelector("#" + inputid);
                    var singleSelectInstance = mdb.Select.getInstance(singleSelect);
                    $input.empty();

                    $.each(data, function(index, value) {
                        $input.append('<option value="' + value + '">' + index + '</option>');
                        singleSelectInstance.setValue(value);
                    });
                });


            });
        </script>
    @endpush

</div>
