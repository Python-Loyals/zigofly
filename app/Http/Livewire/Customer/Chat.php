<?php

namespace App\Http\Livewire\Customer;

use App\Events\AdminText;
use App\Message;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chat extends Component
{
    protected $listeners = ['newMessage', 'openChat', 'closeChat'];

    public $conversation, $message, $user, $unreadMessages, $open;


    public function render()
    {
        return view('livewire.customer.chat');
    }

    public function send()
    {
        if (!empty($this->message)){
            $message = new Message(['message' => trim($this->message)]);

            $message->sender()->associate($this->user);
            $message->save();
            $this->message = '';
            $coll = new Collection();
            $coll->push((object)$message);

            $this->conversation = $this->conversation->merge($coll);

            event(new AdminText());
        }
    }

    public function openChat()
    {
        $this->open = true;
        $this->user = Auth::guard('web')->user();
        $this->conversation = $this->user->conversation;
        $this->emit('scroll');
    }

    public function closeChat()
    {
        $this->open = false;
    }
    public function newMessage()
    {
        $this->user = Auth::guard('web')->user();
        if ($this->user){
            $this->conversation = $this->user->conversation;

            $this->unreadMessages = count($this->user->unreadMessages);
        }
        $this->emit('read_messages');
        if ($this->open){
            $this->emit('scroll');
        }
    }
}