<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LastViewedProduct extends Model
{
    protected $table = 'last_viewed_products';

    protected $fillable = [
        'user_id',
        'product_id'
    ];
}
