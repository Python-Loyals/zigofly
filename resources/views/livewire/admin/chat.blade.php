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
                    <style>
                        .nav-link{
                            color: #5f6368;
                        }
                        .nav-link.active{
                            background: transparent!important;
                            color: #00796b!important;
                            border-radius: 0px!important;
                        }
                        .nav-link:after {
                            display:block;
                            content: '';
                            border-bottom: solid 2px #019fb6;
                            transform: scaleX(0);
                            transition: transform 250ms ease-in-out;
                        }

                        .nav-link.active:after{
                            transform: scaleX(1);
                        }
                        .user-unread{
                            position: relative;
                            display: inline-block;
                            top: -5px;
                            right: -5px;
                            height: 15px;
                            width: 15px;
                            line-height: 15px;
                            text-align: center;
                            color: #fff;
                            -webkit-border-radius: 100%;
                            -moz-border-radius: 100%;
                            border-radius: 100%;
                            font-size: 12px;
                        }
                    </style>
                    {{--                tabs--}}
                    <ul class="nav nav-pills mb-3 mx-2 row" id="pills-tab" role="tablist">
                        <li class="nav-item col-6 pl-0 pr-1">
                            <a class="nav-link active btn-block text-center pr-0 pl-2" id="pills-customers-tab" data-toggle="pill"
                               href="#pills-customers" role="tab" aria-controls="pills-customers" aria-selected="true" wire:ignore.self>
                               <i class="fa fa-users p-r-4"></i> Customers
                            </a>
                        </li>
                        <li class="nav-item btn-block col-6 px-0">
                            <a class="nav-link text-center btn-block" id="pills-staff-tab" data-toggle="pill" href="#pills-staff"
                               role="tab" aria-controls="pills-staff" aria-selected="false" wire:ignore.self>
                                <i class="fa fa-comments"></i> Staff
                            </a>
                        </li>
                    </ul>

                    @php($customers = \App\User::all()->sortByDesc('lastMessage.created_at'))
                    @php($admins = \App\Admin::all()->except(Auth::guard('admin')->user()->id))
                    <div class="main-friend-list">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-customers" role="tabpanel"
                                 aria-labelledby="pills-customers-tab" wire:ignore.self>
                                @forelse($customers as $key => $customer)
                                    <div class="media userlist-box waves-effect waves-light row user"
                                         wire:click="$emit('selected_user',{{$customer->id}})">
                                        <div class="media-left col-2 px-0 pl-1 mr-0">
                                            <img class="media-object img-radius img-radius"
                                                 src="{{count($customer->profile) > 0 ? $customer->profile[0]->thumbnail : asset('images/user.png')}}" alt="Generic placeholder image ">
                                            @if($customer->isOnline)
                                                <div class='status-circle bg-success'></div>
                                            @endif
                                        </div>

                                        <div class="media-body col-10">
                                            <div class="chat-header">
                                            <span class="text-capitalize">
                                                {{$customer->name}}
                                                @if(count($customer->userUnreadMessages) > 0)
                                                    <div class="user-unread bg-success">
                                                        {{count($customer->userUnreadMessages)}}
                                                    </div>
                                                @endif
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
                            <div class="tab-pane fade" id="pills-staff" role="tabpanel"
                                 aria-labelledby="pills-staff-tab" wire:ignore.self>
                                @forelse($admins as $key => $administrator)
                                    <div class="media userlist-box waves-effect waves-light row admin" id="{{$key}}"
                                         wire:click="$emit('selected_admin',{{$administrator->id}})">
                                        <div class="media-left col-2 px-0 pl-1 mr-0">
                                            <img class="media-object img-radius img-radius"
                                                 src="{{count($administrator->profile) > 0 ? $administrator->profile[0]->thumbnail : asset('images/user.png')}}" alt="dp">

                                            @if($administrator->isOnline)
                                                <div class='status-circle bg-success'></div>
                                            @endif
                                        </div>

                                        <div class="media-body col-10">
                                            <div class="chat-header">
                                            <span class="text-capitalize">
                                                {{ $administrator->name }}
                                                @if(count($administrator->adminUnreadMessages) > 0)
                                                    <div class="user-unread bg-success">
                                                        {{count($administrator->adminUnreadMessages)}}
                                                    </div>
                                                @endif
                                            </span>
                                                <small class="d-block text-muted"
                                                       style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis;">
                                                    {{$administrator->lastMessage->message ?? ''}}
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
                    @if($customer_chat)
                        <img class="media-object img-cir m-t-5 bg-light" src="{{count($user->profile) > 0 ? $user->profile[0]->thumbnail : asset('images/user.png')}}">
                    @elseif($staff_chat)
                        <img class="media-object img-cir m-t-5 bg-light" src="{{count($admin->profile) > 0 ? $admin->profile[0]->thumbnail : asset('images/user.png')}}">
                    @endif

                </a>
                <span class="col-8 user-name row align-items-center text-bold text-white" style="text-transform: capitalize">
                    @if($customer_chat)
                        {{$user->name ?? ''}}
                    @elseif($staff_chat)
                        {{$admin->name ?? ''}}
                    @endif
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
                    @if($message->sender_id == Auth::guard('admin')->user()->id && !empty($message->receiver_id))
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
        livewire.on('scroll', () => {
            $(".main-friend-chat").animate({ scrollTop: $(".main-friend-chat")[0].scrollHeight }, 1000);
        });

        livewire.on('notification', () => {
            playNotificationSound()
        });

        livewire.on('new_message_notif', () => {
            playNewMessageSound()
        });

        livewire.on('read_messages', () => {
            $('.unread-messages').text(@this.unreadMessages)
        });

        Echo.channel('chat')
            .listen('.chat', (e)=>{
            @this.call('newMessage');
            })

        let min_height = '38';
        $('#chat-message').on('keydown', function (e) {
            if (e.which == 13 && !e.ctrlKey && !e.altKey && !e.shiftKey){
                e.preventDefault();
                @this.send()
            }else if(e.which == 13 &&( e.ctrlKey || e.altKey || e.shiftKey)){
                let v = $(this).val()
                $(this).val(v+'\n');
            }

            let height = Math.min(20 * 5, $(this)[0].scrollHeight);
            $(this). css('height',  height + 'px');

            if ($(this)[0].scrollHeight > height){
                $(this).css( {
                    'overflow-y': 'auto',
                });
            }else{
                $(this).css( {
                    'overflow-y': 'hidden',
                });
            }
        });

        $('.back_chatBox').on('click', function() {
            $('.showChat_inner').toggleClass('slideInRight');
            $('.showChat_inner').toggleClass('slideOutRight');
            $('body').css('overflow-y', 'auto');
            @this.backChat();
        });

        document.addEventListener("DOMContentLoaded", () => {
            // Livewire.hook('element.updating', (fromEl, toEl, component) => {})
            // Livewire.hook('message.sent', (message, component) => {
            //     console.log(message)
            //     console.log(component)
            // })
            // Livewire.hook('message.received', (message, component) => {})
            // Livewire.hook('message.processed', (message, component) => {})
        });
    </script>
@endsection

