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
        'amount',
        'status',
        'customer_id',
        'quoted_by',
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

    public function getAttachmentsAttribute()
    {
        $files = $this->getMedia('attachment');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }

    public function products()
    {
        return $this->hasMany(QuoteProduct::class, 'quote_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function services()
    {
        return $this->hasMany(QuoteService::class, 'quote_id');
    }

    public function payment()
    {
        return $this->morphOne(Transaction::class, 'payment');
    }

}
