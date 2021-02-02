<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $table = 'checkouts';

    protected $fillable = [
        'user_id',
        'amount'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
