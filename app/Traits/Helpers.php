<?php

namespace App\Traits;

use App\Http\Controllers\Services\Services;
use Illuminate\Support\Facades\Validator;

trait Helpers
{
    private function setService($service)
    {
        return Services::createInstance($service) ?? new Services();
    }

    public function setFields($fillable)
    {
        foreach ($fillable as $field) {
            // if ($field == 'images') {
            //     $this->{$field} = [];
            //     continue;
            // }
            $this->{$field} = null;
        }
    }

    public function getFieldsValues($fillable)
    {
        $data = [];
        foreach ($fillable as $field) {
            $data[$field] = $this->{$field};
        }
        return $data;
    }

    public function alertMessage($message, $type)
    {
        $this->alert($type, '', [
            'toast' => true,
            'position' => 'center',
            'timer' => 3000,
            'text' => $message,
        ]);
    }

    public function makeValidation($service, $data, $emit, $id = "")
    {
        $this->rules = $service->rules($id);
        $this->messages = $service->messages();

        $validator = Validator::make($data, $this->rules, $this->messages);
        $errors = array_map(fn ($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->emit($emit, $errors);
            return false;
        }

        return true;
    }

    public function getContent($service, $type = "Creator")
    {
        $this->title = $service->title_updater;
        $this->updater_id = $service->updater_id;
        $this->creator_id = $service->creator_id;
        $this->size = $service->modal_size;
        $this->tabs = $service->tabs();
        $this->contents = $service->contents($type);
    }

    public function apiResponseMessage($status, $code, $message, $data = [])
    {
        return response()->json([
            'status' => $status,
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}
