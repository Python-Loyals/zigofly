<?php

namespace App\Http\Livewire\Customer;

use App\Events\AdminText;
use App\Message;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chat extends Component
{
    protected $listeners = ['newMessage'];

    public $conversation, $message, $user, $unreadMessages, $open;

    public function hydrate()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.customer.chat');
    }

    public function send()
    {
        if (!empty($this->message)){
            $message = new Message(['message' => trim($this->message)]);

            $message->sender()->associate(Auth::guard('web')->user());
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
        $this->conversation = $this->user->conversation;
        $this->emit('scroll');
    }

    public function closeChat()
    {
        $this->open = false;
    }
    public function newMessage()
    {
        if ($this->user){
            $this->conversation = $this->user->conversation;

            $this->unreadMessages = count($this->user->unreadMesusersages);
        }
        $this->emit('read_messages');
        if ($this->open){
            $this->emit('scroll');
        }
    }
}
