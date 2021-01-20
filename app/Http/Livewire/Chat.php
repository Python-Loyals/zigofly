<?php

namespace App\Http\Livewire;

use App\Message;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chat extends Component
{
    protected $listeners = ['selected_user', 'refresh' => 'render'];

    public $conversation,$message, $chat_id, $chat_user, $unreadMessages, $paginate_var=20;

    public $update;

    public function render()
    {
        return view('livewire.chat');
    }

    public function selected_user($id)
    {
        $this->chat_id = $id;

        $this->chat_user = User::findOrFail($this->chat_id);

        $this->chat_user->sentMessages()->update(['read'=> 1]);

        // number of messages I want to show
        $this->paginate_var = 20;

        $this->conversation = $this->chat_user->conversation;
    }

    public function send()
    {
        if (!empty($this->message)){
            $message = new Message(['message' => trim($this->message)]);

            $message->sender()->associate(Auth::user());
            $message->receiver()->associate(User::find($this->chat_id));
            $message->save();
            $this->message = '';
            $coll = new Collection();
            $coll->push((object)$message);

            $this->conversation = $this->chat_user->conversation->merge($coll);
        }
    }
}
