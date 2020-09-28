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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
