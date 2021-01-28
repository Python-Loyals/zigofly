<?php

namespace App;

use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
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

    public function adminSentMessages()
    {
        return $this->sentMessages()
            ->whereHasMorph('receiver', Admin::class)
            ->where('receiver_id', '=', Auth::guard('admin')->id());
    }

    public function adminReceivedMessages()
    {
        return $this->receivedMessages()
            ->where('sender_id', '=', Auth::guard('admin')->id());
    }

    public function getLastMessageAttribute()
    {
        return $this->adminReceivedMessages
            ->merge($this->adminSentMessages)
            ->sortByDesc('created_at')->first();
    }

    public function getAdminUnreadMessagesAttribute()
    {
        return $this->sentMessages()
            ->where('receiver_id', '=', Auth::guard('admin')->id())
            ->where('read', '=', 0)
            ->get();
    }

    public function getUnreadMessagesAttribute()
    {
        $staff = $this->receivedMessages()
            ->where('receiver_id', '=', Auth::guard('admin')->id())
            ->where('read', '=', 0)->get();
        $user = Message::whereHasMorph('sender', User::class)
            ->where('read', '=', 0)
            ->get();
        return $staff->merge($user);
    }

    public function getConversationAttribute()
    {
        return $this->adminReceivedMessages->merge($this->adminSentMessages)->sortBy('created_at');
    }

}
