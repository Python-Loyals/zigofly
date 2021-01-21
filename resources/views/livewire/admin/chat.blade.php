<div class="w-100">
    <div id="sidebar" class="users p-chat-user showChat" wire:ignore.self>
        <div class="had-container">
            <div class="p-fixed users-main">
                <div class="user-box">
                    <div class="chat-search-box">
                        <a class="back_friendlist">
                            <i class="zmdi zmdi-chevron-right"></i>
                        </a>
                        <div class="right-icon-control">
                            <div class="input-group input-group-button">
                                <input type="text" id="search-friends" name="footer-email" class="form-control" placeholder="Search for a customer">
                                <div class="input-group-append">
                                    <button class="btn btn-primary waves-effect waves-light py-0" type="button"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                tabs--}}
                    <ul class="nav nav-pills mb-3 mx-2" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-customers-tab" data-toggle="pill"
                               href="#pills-customers" role="tab" aria-controls="pills-customers" aria-selected="true">Customers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-staff-tab" data-toggle="pill" href="#pills-staff"
                               role="tab" aria-controls="pills-staff" aria-selected="false">Staff</a>
                        </li>
                    </ul>

                    @php($customers = \App\User::all()->sortByDesc('lastMessage.created_at'))
                    @php($admins = \App\Admin::all()->except(Auth::user()->id))
                    <div class="main-friend-list">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-customers" role="tabpanel" aria-labelledby="pills-customers-tab">
                                @forelse($customers as $key => $customer)
                                    <div class="media userlist-box waves-effect waves-light"
                                         wire:click="$emit('selected_user',{{$customer->id}})">
                                        <a class="media-left" href="#!">
                                            <img class="media-object img-radius img-radius"
                                                 src="{{asset('/account/uploads/avatar.png')}}" alt="Generic placeholder image ">
                                            @if($customer->isOnline)
                                                <div class='status-circle bg-success'></div>
                                            @endif
                                        </a>

                                        <div class="media-body">
                                            <div class="chat-header">
                                            <span class="text-capitalize">
                                                {{$customer->name}}
                                            </span>
                                                <small class="d-block text-muted"
                                                       style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis;">
                                                    {{$customer->lastMessage->message ?? ''}}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                @empty

                                @endforelse
                            </div>
                            <div class="tab-pane fade" id="pills-staff" role="tabpanel" aria-labelledby="pills-staff-tab">
                                @forelse($admins as $key => $admin)
                                    <div class="media userlist-box waves-effect waves-light" data-recipient="{{$admin->id}}"
                                         data-profile="{{asset('/account/uploads/avatar.png')}}" data-username='{{$admin->name}}'
                                         data-uid="{{Auth::id()}}">
                                        <a class="media-left" href="#!">
                                            <img class="media-object img-radius img-radius"
                                                 src="{{asset('/account/uploads/avatar.png')}}" alt="dp">

                                            @if($admin->isOnline)
                                                <div class='status-circle bg-success'></div>
                                            @endif
                                        </a>

                                        <div class="media-body">
                                            <div class="chat-header">
                                            <span class="text-capitalize">
                                                {{ $admin->name }}

                                            </span>
                                                <small class="d-block text-muted"
                                                       style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis;">
                                                    {{$admin->lastMessage->message ?? ''}}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                @empty

                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="showChat_inner" wire:ignore.self>
        <div class="media chat-inner-header row align-items-start mb-0 pb-3 pl-0 ml-0">
            <a class="back_chatBox">
                <i class="zmdi zmdi-chevron-right"></i>
            </a>
            <div class="w-100 row">
                <a class="media-left photo-table col-4 pr-0" href="#!">
                    <img class="media-object img-cir m-t-5 bg-light" src="{{asset('account/uploads/avatar.png')}}" alt="Generic placeholder image">
                </a>
                <span class="col-8 user-name row align-items-center text-bold text-white" style="text-transform: capitalize">
                {{$chat_user->name ?? ''}}
            </span>
            </div>
        </div>
        <style>
            .chat-time{
                font-size:14px
            }
            @media only screen and (max-width:575px){
                .chat-time{
                    font-size:13px
                }
            }
        </style>
        <div class="main-friend-chat mt-2 pb-3" style="height: 72%!important;">
            @if($conversation)
                @foreach($conversation as $message)
                    @if($message->sender_id == Auth::user()->id && !empty($message->receiver_id))
                        <div class="media chat-messages">
                            <div class="media-body chat-menu-reply">
                                <div class="">
                                    <p class="chat-cont">{!! nl2br($message->message) ?? '' !!}</p>
                                </div>
                                <p class="chat-time">
                                    {{\Carbon\Carbon::parse($message->created_at)->diffForHumans() ?? ''}}
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="media chat-messages">
                            <div class="media-body chat-menu-content pl-3">
                                <div class="">
                                    <div class="chat-header ml-auto text-right">
                                        ~{{$message->sender->name}}
                                    </div>
                                    <p class="chat-cont">{!! nl2br($message->message) ?? '' !!}</p>
                                </div>
                                <p class="chat-time">
                                    {{\Carbon\Carbon::parse($message->created_at)->diffForHumans() ?? ''}}
                                </p>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
        <div class="chat-reply-box pr-1">
            <form id="chat-form" wire:submit.prevent="send">
                <div class="right-icon-control">
                    <div class="row">
                        <div class="col-9 px-0 ml-2">
                            <textarea name="message" id="chat-message" wire:model="message" wire:ignore.self
                                      placeholder="Type message here..." rows="1"></textarea>
                        </div>
                        <div class="col-3 pr-1 row justify-content-center align-items-center">
                            <button class="waves-effect waves-light btn-send py-0 mb-3" type="submit">
                                <i class="zmdi zmdi-mail-send text-primary fs-23"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@section('scripts')
    @parent
    <script>
        livewire.on('read_messages', () => {
            $('.unread-messages').text(@this.unreadMessages)
        });

        livewire.on('scroll', () => {
            $(".main-friend-chat").animate({ scrollTop: $(".main-friend-chat")[0].scrollHeight }, 1000);
        });

        Echo.channel('chat')
        .listen('.chat', (e)=>{
            console.log(e)
            @this.call('newMessage');
        })
    </script>
@endsection

