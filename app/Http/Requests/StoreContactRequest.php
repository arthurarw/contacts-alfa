<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $id = $this->segment(2);

        return [
            'name' => 'required|min:5|max:255',
            'contact' => "required|min:9|max:9|unique:contacts,contact,{$id},id",
            'email' => "required|email|unique:contacts,email,{$id},id"
        ];
    }
}
