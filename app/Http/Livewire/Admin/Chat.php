<?php

namespace App\Http\Livewire\Admin;

use App\Admin;
use App\Events\AdminText;
use App\Message;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chat extends Component
{
    protected $listeners = ['selected_user','selected_admin', 'newMessage'];

    public $conversation,$message, $chat_id, $user, $unreadMessages, $paginate_var=20;
    public $admin, $admin_id, $staff_chat = false, $customer_chat = false;

    public $update;

    public function mount()
    {
        $this->unreadMessages = count(Auth::guard('admin')->user()->unreadMessages) ?? 0;
    }

    public function render()
    {
        return view('livewire.admin.chat');
    }

//    public function hydrateAdmin(){
//        $this->reset(['user', 'chat_id', 'conversation']);
//    }
//
//    public function hydrateUser()
//    {
//        $this->reset(['admin', 'admin_id', 'conversation']);
//    }

    public function selected_user($id)
    {
        $this->staff_chat = false;
        $this->customer_chat = true;
        $this->chat_id = $id;

        $this->user = User::findOrFail($this->chat_id);

        $this->user->sentMessages()
            ->update(['read'=> 1]);

        $this->conversation = $this->user->conversation;
        $this->unreadMessages = count(Auth::guard('admin')->user()->unreadMessages);
        $this->emit('read_messages');
    }

    public function selected_admin($id)
    {
        $this->staff_chat = true;
        $this->customer_chat = false;

        $this->admin_id = $id;

        $this->admin = Admin::findOrFail($this->admin_id);

        $this->admin->adminSentMessages()
            ->update(['read'=> 1]);

        $this->conversation = $this->admin->conversation;
        $this->unreadMessages = count(Auth::guard('admin')->user()->unreadMessages);
        $this->emit('read_messages');
    }

    public function send()
    {
        if (!empty($this->message) && (!empty($this->admin) || !empty($this->user))){
            $message = new Message(['message' => trim($this->message)]);

            $message->sender()->associate(Auth::guard('admin')->user());
            if ($this->customer_chat){
                $message->receiver()->associate($this->user);
            }elseif ($this->staff_chat){
                $message->receiver()->associate($this->admin);
            }
            $message->save();
            $this->message = '';
            $coll = new Collection();
            $coll->push((object)$message);

            if ($this->customer_chat){
                $this->conversation = $this->user->conversation->merge($coll);
            }elseif ($this->staff_chat){
                $this->conversation = $this->admin->conversation->merge($coll);
            }

            event(new AdminText());
        }
    }

    public function newMessage()
    {
        if ($this->customer_chat){
            $this->conversation = $this->user->conversation ?? [];
        }elseif ($this->staff_chat){
            $this->conversation = $this->admin->conversation ?? [];
        }
        $this->unreadMessages = count(Auth::guard('admin')->user()->unreadMessages);
        $this->emit('read_messages');
        if ($this->user || $this->admin){
            $this->emit('scroll');
        }
    }
}
