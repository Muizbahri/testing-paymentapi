<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillplzPayment extends Model
{
    protected $table = 'BillplzPayment';

    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'amount_donation',
        'bill_id',
        'collection_id',
        'state',
        'paid',
        'paid_amount',
        'bill_url',
        'raw_response'
    ];
    
}
