<?php

namespace App;

use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Passport\HasApiTokens;

class Admin extends Authenticatable
{
    use SoftDeletes, Notifiable, HasApiTokens;

    public $table = 'admins';

    public $guard = 'admin';

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getIsOnlineAttribute()
    {
        return Cache::has('admin-is-online-' . $this->id);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
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

}
