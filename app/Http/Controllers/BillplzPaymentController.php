<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Models\BillplzPayment;
use App\Services\BillplzService;
use Illuminate\Http\Request;

class BillplzPaymentController extends Controller{
    public function store(StorePaymentRequest $request, BillplzService $billplzService){

        $validated = $request->validated();

        $response = $billplzService->createBill($validated);

        if($response->failed()){
            return redirect()->back()
            ->withErrors(['billplz' => 'Failed to connect to Billplz API']);
        }

        $bill = $response->json();

        BillplzPayment::create([
            'full_name' => $validated['full_name'],
            'email' =>  $validated['email'],
            'phone_number' => $validated['phone_number'],
            'amount_donation' => $validated['amount_donation'],
            'bill_id' => $bill['id'] ?? null,
            'collection_id' => $bill['collection_id'],
            'state' => $bill['state'] ?? 'due',
            'paid' => $bill['paid'],
            'paid_amount' => $bill['paid_amount'] ?? 0,
            'bill_url' => $bill['url'] ?? null,
            'raw_response' => json_encode($bill),
        ]);

        if(!empty($bill['url'])){
            return redirect() -> away($bill['url']);
        }

        return redirect()->back()->with('success', 'Bill created and saved successfully!');
    }

    public function handleReturn(Request $request){
        $billplzData = $request->input('billplz');
        $billId = $billplzData['id'] ?? null;
        $isPaid = false;

        if($billId){
            $payment = BillplzPayment::where('bill_id', $billId) -> first();

            if($payment){
                $isPaid = ($billplzData['paid'] == 'true');

                $payment->update([

                    'paid' => $isPaid,
                    'state' => $isPaid ? 'paid' : 'due',
                    'paid_amount' => $isPaid ? $payment->amount_donation : 0.00,
                    'raw_response' => json_encode($billplzData),
                ]);
            }
        }

        if($isPaid){
            return redirect('/')->with('success', 'Payment completed and saved to database!');
        }
        return redirect('/')->withErrors(['payments' => 'Payment failed or was cancelled. Status saved as unpadi in database.']);
    }

    public function handleCallback(Request $request){
        $billId = $request->input('id');

        if($billId){
            $payment = BillplzPayment::where('bill_id', $billId)->first();

            if($payment){
                $isPaid = ($request->input('paid') == 'true');

                $payment->update([
                    'state' => $request ->input('state'),
                    'paid' => $isPaid,
                    'paid_amount' => $request->input('paid_amount') / 100,
                    'raw_response' => json_encode($request->all()),
                ]);
            }
        }

        return response('OK', 200);
    }
}

?>