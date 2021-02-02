<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StkRequest extends Model
{
    protected $table = 'stk_requests';

    protected $fillable = [
        'request_id',
        'msisdn',
        'bill_ref_number',
        'amount',
        'paid',
    ];

    public function response()
    {
        return $this->hasOne(StkResponse::class, 'request_id');
    }
}
