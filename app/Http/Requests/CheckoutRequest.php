<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:20'],
            'customer_address' => ['required', 'string', 'max:500'],
            'customer_email' => ['required', 'email', 'max:255'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'customer_name.required' => 'اسم العميل مطلوب',
            'customer_name.string' => 'اسم العميل يجب أن يكون نص',
            'customer_name.max' => 'اسم العميل يجب ألا يتجاوز 255 حرف',

            'customer_phone.required' => 'رقم الهاتف مطلوب',
            'customer_phone.string' => 'رقم الهاتف يجب أن يكون نص',
            'customer_phone.max' => 'رقم الهاتف يجب ألا يتجاوز 20 رقم',

            'customer_address.required' => 'العنوان مطلوب',
            'customer_address.string' => 'العنوان يجب أن يكون نص',
            'customer_address.max' => 'العنوان يجب ألا يتجاوز 500 حرف',

            'customer_email.required' => 'البريد الإلكتروني مطلوب',
            'customer_email.email' => 'البريد الإلكتروني يجب أن يكون صحيح',
            'customer_email.max' => 'البريد الإلكتروني يجب ألا يتجاوز 255 حرف',

            'notes.string' => 'الملاحظات يجب أن تكون نص',
            'notes.max' => 'الملاحظات يجب ألا تتجاوز 1000 حرف',
        ];
    }
}
