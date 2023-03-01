<?php

namespace App\Http\Requests\Tweet;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * ユーザー情報を判別して、リクエストを認証する
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * リクエストに適用されるバリデーションチェック
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'tweet' => 'required|max:140' // 必須かつ140文字以下
        ];
    }

    /** 
     * 送信されたtweetを取得する
     * 
    */
    public function tweet() {
        // input(取得する名前, デフォルト値)
        // 必須なのでデフォルト値は不要
        return $this->input('tweet');
    }
}
