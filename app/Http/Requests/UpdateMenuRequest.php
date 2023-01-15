<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuRequest extends FormRequest
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
            "title"=>"required|min:3|unique:menus,title,".$this->menu->id,
            "description"=>"required|min:5",
            "price"=>"required|numeric",
            "image"=>"mimes:png,jpg,jpeg|max:2048",
            "category_id"=>"required|numeric"
        ];
    }
}
