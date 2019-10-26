<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponPost extends FormRequest
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
        // ユーザーがコントロールするリクエストの入力をignoreメソッドへ、決して渡してはならない
        return [
            'id' => 'bail|required|unique:coupons|max:255',
            'name' => 'bail|required|max:255',
            'point' => 'required|integer'
        ];
    }
}
