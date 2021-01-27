<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
        $rules = [
            'money_count' =>'required|min:1|max:999999|numeric',
            'currency' =>'required'
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'money_count.required' => 'Введите сумму для зачисления',
            'money_count.numeric' => 'Не корректная сумма',
            'money_count.max' => 'Превышен лимит денег. Максимум 999999',
            'money_count.min' => 'Сумма должна быть 1 или больше',
            'currency.required' => 'Выберите валюту',
        ];
    }
}
