<?php

namespace App\Http\Requests;

use App\Http\Controllers\UserController;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
         public function rules()
    {
        $id = request()->id;
        return [
            'fullname' => 'required|min:3',
            'email'=> 'required|email|unique:users,email,' .$id
        ];
    }

    public function messages(){
        return [
            'fullname.required' => ':attribute bat buoc phai nhap',
            'fullname.min' => ':attribute bat buoc lon hon :min ky tu',
            'email.required' => ':attribute bat buoc phai nhap',
            'email' => ':attribute khong dung',
            'unique' => ':attribute ton tai',
        ];
    }

    public function attributes(){
        return [
            'fullname' => 'Ho va ten',
            'email' => 'Email'
        ];
    }

    protected function withValidator($validator){
        $validator->after(function ($validator) {
            if($validator->errors()->count() > 0){
                $validator->errors()->add('msg', 'da co loi xay ra vui long kiem tra lai');
            }
         });
    }
  
}