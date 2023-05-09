<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        return [
            'fullname' => 'required|min:3',
            'email'=> 'required|email|unique:users',
            'group_id' => 'required|numeric|gt:0'
                
        ];
    }

    public function messages(){
        return [
            'fullname.required' => ':attribute bat buoc phai nhap',
            'fullname.min' => ':attribute bat buoc lon hon :min ky tu',
            'email.required' => ':attribute bat buoc phai nhap',
            'email' => ':attribute khong dung dinh dang',
            'unique' => ':attribute ton tai',
            'gt' => ':attribute bat buoc phai nhap',
            'numeric'  => ':attribute khong dung dinh dang',
        ];
    }

    public function attributes(){
        return [
            'fullname' => 'Ho va ten',
            'email' => 'Email',
            'group_id' => 'Nhóm'
        ];
    }

    protected function withValidator($validator){
        $validator->after(function ($validator) {
            if($validator->errors()->count() > 0){
                $validator->errors()->add('msg', 'da co loi xay ra vui long kiem tra lai');
            }
         });
    }
    // khi xu ly truoc validate
    protected function prepareForValidation(){
        $this->merge([
            'create_at' => date('Y-m-d H:i:s'),
        ]);
    }
    
}