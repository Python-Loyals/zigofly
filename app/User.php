<?php

namespace App;

use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Laravel\Passport\HasApiTokens;
use \DateTimeInterface;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use SoftDeletes, Notifiable, HasApiTokens, HasMediaTrait;

    public $table = 'users';

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
        'county',
        'age',
        'phone'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 150, 150);
    }

    public function getProfileAttribute()
    {
        $profile = $this->getMedia('customer_profile');

        $profile->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });


        return $profile;
    }

    public function getIsOnlineAttribute()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function userAge()
    {
        return $this->belongsTo(Age::class, 'age');
    }

    public function userCounty()
    {
       return $this->belongsTo(County::class, 'county');
    }

    public function lastViewed()
    {
        return $this->hasMany(LastViewedProduct::class, 'user_id')->orderBy('updated_at');
    }

    public function userQuotes()
    {
        return $this->hasMany(Quote::class, 'customer_id')->orderBy('id', 'DESC');
    }

    public function userOrders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function sentMessages()
    {
        return $this->morphMany(Message::class, 'sender');
    }

    public function receivedMessages()
    {
        return $this->morphMany(Message::class, 'receiver');
    }

    public function getLastMessageAttribute()
    {
        return $this->receivedMessages->merge($this->sentMessages)->sortByDesc('created_at')->first();
    }

    public function getUserUnreadMessagesAttribute()
    {
        return $this->sentMessages()
            ->where('read', '=', 0)
            ->get();
    }

    public function getConversationAttribute()
    {
        return $this->receivedMessages->merge($this->sentMessages)->sortBy('created_at');
    }
    public function getUnreadMessagesAttribute()
    {
        return $this->receivedMessages()->where('read', '=', 0)->get();
    }
}
