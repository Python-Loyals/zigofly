<?php

namespace App;

use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
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

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }


}
