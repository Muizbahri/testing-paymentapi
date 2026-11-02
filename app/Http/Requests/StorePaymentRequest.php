<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void{
        $this->merge([
            'full_name' => strip_tags(trim((string) $this->input('full_name'))),
            'email'     => filter_var(trim((string) $this->input('email')), FILTER_SANITIZE_EMAIL),
            'phone_number' => preg_replace('/[^0-9]/', '', (string) $this->input('phone_number')),
            'amount_donation' => trim((string) $this->input('amount_donation')),      
        ]);
    }

    public function rules(): array{
        return [
            'full_name' => ['required', 'string', 'min:2', 'max:100', 'regex:/^[a-zA-Z\s\.\'\-\@\/]+$/'],
            'email' => ['required','string','email:rfc', 'max:255'],
            'phone_number' => ['required','numeric','digits_between:9,15'],
            'amount_donation' => ['required', 'numeric', 'min:1', 'max:1000000'],
        ];
    }

    public function message(): array {
        return[
            'full_name.required'  => 'Please enter your full name.',
            'full_name.regex' => 'Full name may only contain letters and spaces.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address containing "@ ".',
            'phone_number.required' => 'Please enter your phone number.',
            'phone_number.digits_between' => 'Phone number must be between 9 and 15 digits.',
            'amount_donation.requires' => 'Please enter a donation amount.',
            'amount_donation.numeric' => 'Donation amount must be a valid number.',
            'amount_donation.min' => 'Donation amount must be at lease RM 1.'
        ];
    }

}

?>