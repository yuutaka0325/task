<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            //
        ];
    }

    public function attributes()
{
    return [
        'title' => 'タイトル',
        'url' => 'URL',
        'comment' => 'コメント',
    ];
}

/**
 * エラーメッセージ
 *
 * @return array
 */
public function messages() {
    return [
        'title.required' => ':attributeは必須項目です。',
        'title.max' => ':attributeは:max字以内で入力してください。',
        'url.required' => ':attributeは必須項目です。',
        'url.max' => ':attributeは:max字以内で入力してください。',
        'url.url' => ':attributeはURL形式で入力してください。',
        'comment.max' => ':attributeは:max字以内で入力してください。',
    ];
}
}
