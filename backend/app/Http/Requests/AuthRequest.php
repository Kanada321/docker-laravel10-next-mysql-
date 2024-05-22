<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'userId' => 'required|string|max:255',
            'password' => 'required|string|min:5',
        ];

        if ($this->isMethod('post') && $this->route()->getName() === 'register') {
            // 新規登録の場合、userIdが一意であることを確認
            $rules['userId'] .= '|unique:users,userId';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'userId.required' => ':attribute は必須です。',
            'userId.string' => ':attribute は文字列でなければなりません。',
            'userId.max' => ':attribute は255文字以内でなければなりません。',
            'userId.unique' => 'この :attribute は既に使用されています。',
            'password.required' => ':attribute は必須です。',
            'password.string' => ':attribute は文字列でなければなりません。',
            'password.min' => ':attribute は少なくとも8文字でなければなりません。',
        ];
    }

    public function attributes()
    {
        return [
            'userId' => 'ユーザーID',
            'password' => 'パスワード',
        ];
    }
}
