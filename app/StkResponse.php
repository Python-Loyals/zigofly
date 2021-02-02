<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StkResponse extends Model
{
    protected $table = 'stk_responses';

    protected $fillable = [
        'merchant_request_id',
        'request_id',
        'phone_number',
        'receipt_number',
        'amount',
        'result_code',
        'result_description'
    ];

    public function request()
    {
        return $this->belongsTo(StkRequest::class, 'request_id', 'id');
    }
}
