<?php

namespace App\Http\Requests\api;

use App\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = Auth::user()->id;
        return [
            'phone' => 'nullable|unique:users,phone,' . $id . ',id|regex:/^998[0-9]{9}/',
            'full_name' => 'nullable|string',
//            'email' => 'required|email|unique:users,email',//email will not be updated
            'current_password' => 'required_with:new_password|min:6',
            'new_password' => 'required_with:current_password|confirmed|min:6'
        ];
    }
}
