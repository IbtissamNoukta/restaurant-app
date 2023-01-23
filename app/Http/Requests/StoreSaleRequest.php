<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
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
            "table_id"=>"required",
            "menu_id"=>"required",
            "quantity" => "required",
            "servant_id"=>"required",
            "total_price"=>"required|numeric",
            "total_received"=>"required|numeric",
            "change"=>"required|numeric",
            "payment_type"=>"required",
            "payment_status"=>"required"

        ];
    }
}
