<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class BillplzService{
    public function createBill(array $validated): Response{
        $amountInCents = (int) round(((float) $validated['amount_donation']) * 100);

        return Http::withBasicAuth(config('services.billplz.key'), '')
        ->asForm()
        ->post(config('services.billplz.url'),[
            'collection_id' => config('services.billplz.collection_id'),
            'email' => $validated['email'],
            'mobile' => $validated['phone_number'],
            'name' => $validated['full_name'],
            'amount' => $amountInCents,
            'callback_url' => route('payments.callback'),
            'redirect_url' => route('payments.return'),
            'description' => 'Donation Payment',
        ]);
    }
}

?>