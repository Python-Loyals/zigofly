<?php

namespace App;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'color',
        'size',
        'other_options'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id','product_id');
    }
}
