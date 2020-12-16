<?php

namespace App;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Quote extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $table = 'quotes';

    protected $appends = [
        'attachments'
    ];

    protected $dates = [
      'created_at',
      'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'instructions',
        'service',
        'products',
        'attachment',
        'amount',
        'status',
        'customer_id'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function products()
    {
        return $this->hasMany(QuoteProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
