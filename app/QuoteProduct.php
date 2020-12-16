<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuoteProduct extends Model
{
    use SoftDeletes;

    protected $table = 'quote_products';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at'
    ];

    protected $fillable = [
        'name',
        'link',
        'quantity',
        'options',
        'quote_id'
    ];

    public function order()
    {
        return $this->belongsTo(Quote::class, 'quote_id');
    }
}
