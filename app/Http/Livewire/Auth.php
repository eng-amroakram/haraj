<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Services\AuthService;
use App\Models\User;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Auth extends Component
{
    use LivewireAlert;
    protected $listeners = [
        "submit" => "submit",
        'logout' => 'logout',
    ];

    public $email = '';
    public $password = '';

    public $is_auth = false;

    public function mount($is_auth = false)
    {
        $this->is_auth = $is_auth;
    }

    public function render()
    {
        return view('livewire.auth');
    }

    public function submit(AuthService $authService)
    {
        $validator = Validator::make([
            "email" => $this->email,
            "password" => $this->password,
        ], [
            "email" => ['required', 'email'],
            "password" => ["required"],
        ], [
            "email.required" => "هذ الحقل مطلوب",
            "email.email" => "ادخل ايميل صحيح لو سمحت",
            "password.required" => "هذ الحقل مطلوب",
        ]);

        $errors = array_map(fn ($value) => $value[0], $validator->errors()->toArray());
        if (count($errors)) {
            $this->emit('errors', $errors);
            return  false;
        }

        if ($validator->passes()) {

            $data = $validator->validated();
            $result = $authService->login($data);

            if ($result == "password") {
                $this->emit('errors', ['email' => "كلمة السر خاطئة"]);
                return false;
            }

            if ($result == "email") {
                $this->emit('errors', ['email' => "الايميل الذي ادخلته غير موجود"]);
                return false;
            }

            if ($result == "error") {
                $this->alert('error', 'لقد حدث خطأ غير متوقع، يرجى مراجعة الدعم الفني', [
                    'position' => 'center',
                    'timer' => 3000,
                    'toast' => true,
                    'timerProgressBar' => true,
                ]);
                return false;
            }

            return $result;
        }
    }

    public function logout(AuthService $authService)
    {
        return $authService->logout();
    }
}
