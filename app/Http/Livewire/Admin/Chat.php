<?php

namespace App\Http\Livewire\Admin;

use App\Events\AdminText;
use App\Message;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chat extends Component
{
    protected $listeners = ['selected_user', 'newMessage'];

    public $conversation,$message, $chat_id, $chat_user, $unreadMessages, $paginate_var=20;

    public $update;

    public function mount()
    {
        $this->unreadMessages = count(Auth::guard('admin')->user()->unreadMessages) ?? 0;
    }

    public function render()
    {
        return view('livewire.admin.chat');
    }

    public function selected_user($id)
    {
        $this->chat_id = $id;

        $this->chat_user = User::findOrFail($this->chat_id);

        $this->chat_user->sentMessages()
            ->update(['read'=> 1]);

        $this->conversation = $this->chat_user->conversation;
        $this->unreadMessages = count(Auth::guard('admin')->user()->unreadMessages);
        $this->emit('read_messages');
    }

    public function send()
    {
        if (!empty($this->message)){
            $message = new Message(['message' => trim($this->message)]);

            $message->sender()->associate(Auth::guard('admin')->user());
            $message->receiver()->associate(User::find($this->chat_id));
            $message->save();
            $this->message = '';
            $coll = new Collection();
            $coll->push((object)$message);

            $this->conversation = $this->chat_user->conversation->merge($coll);

            event(new AdminText());
        }
    }

    public function newMessage()
    {
        if ($this->chat_user){
            $this->conversation = $this->chat_user->conversation ?? [];
        }
        $this->unreadMessages = count(Auth::guard('admin')->user()->unreadMessages);
        $this->emit('read_messages');
        if ($this->chat_user){
            $this->emit('scroll');
        }
    }
}
