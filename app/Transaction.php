<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $table = 'transactions';

    protected $fillable = [
        'receipt_number',
        'amount',
        'status',
    ];

    public function paymentable()
    {
        return $this->morphTo();
    }
}
