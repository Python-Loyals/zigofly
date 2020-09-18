<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'countries';
    protected $fillable = [
        'street_one',
        'street_two',
        'city',
        'state',
        'county',
        'country',
        'zip_code',
        'phone',
        'name_suffix',
    ];
}
