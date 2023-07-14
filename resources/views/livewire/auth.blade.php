<div wire:ignore>

    <div class="mask" style="background-color: rgba(191, 70, 68, 0.5)" wire:loading>
        <div class="position-absolute w-100 h-100 d-flex flex-column align-items-center justify-content-center">
            <div class="spinner-border" role="status">
            </div>
            <h4>جاري التحميل يرجى الانتظار ...</h4>
        </div>
    </div>

    @if ($is_auth)
        <p>قم بتسجيل الدخول لو سمحت !!</p>

        <div class="form-outline mb-4">
            <input type="email" id="email" name="email" class="form-control inputText" />
            <label class="form-label" for="email">الايميل</label>
            <small class="text-danger email_validation reset"></small>
        </div>

        <div class="form-outline mb-4">
            <input type="password" id="password" name="password" class="form-control inputText" />
            <label class="form-label" for="password">كلمة السر</label>
            <small class="text-danger password_validation reset"></small>
        </div>

        <div class="text-center pt-1 mb-5 pb-1">
            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3 login-submit" type="button">تسجيل
                الدخول</button>
        </div>
    @endif


    @push('login')
        <script>
            $(document).ready(function() {
                var $inputText = $(".inputText");
                var $loginSubmit = $(".login-submit");
                var $logout = $(".logout");

                var $data = [];

                function setData(key, value) {
                    $data[key] = value;
                }

                function getContent() {
                    var $object = Object.assign({}, $data);
                    return JSON.stringify($object);
                }


                $inputText.on("input", function() {
                    let $value = $(this).val();
                    let $name = $(this).attr('name');
                    setData($name, $value);
                });

                $loginSubmit.on('click', function() {
                    for (let key in $data) {
                        if ($data.hasOwnProperty(key)) {
                            @this.set(key, $data[key]);
                        }
                    }
                    Livewire.emit('submit');
                });

                Livewire.on("errors", function(errors) {
                    $(".reset").text("");

                    for (let key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            $("." + key + "_validation").text(errors[key]);
                        }
                    }

                    console.log(errors);
                });

                $logout.on('click', function() {
                    Livewire.emit('logout');
                });

            });
        </script>
    @endpush


</div>
