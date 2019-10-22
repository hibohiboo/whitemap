<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class StoreTagPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * ユーザがこのリクエストの権限を持っているかを判断する
     *
     * @return bool
     */
    public function authorize()
    {
        // そもそも管理者しかタグの更新は行わないためここでは判定しない
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:2',
            'value' => 'required|integer'
        ];
    }

    /**
     * 定義済みバリデーションルールのエラーメッセージ取得
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '名前は必須です',
            'name.max' => '名前は255文字以内で入力してください',
            'value.required'  => '値は必須です',
        ];
    }
}
