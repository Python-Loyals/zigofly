<div>
    <div class="showChat_inner" wire:ignore.self>
        <div class="media chat-inner-header row align-items-start mb-0 pb-3 pl-0 ml-0">
            <a class="back_chatBox" wire:click="closeChat">
                <i class="zmdi zmdi-chevron-right"></i>
            </a>
            <div class="w-100 row">
                <a class="media-left photo-table col-4 pr-0" href="#!">
                    <img class="media-object img-cir m-t-5 bg-light" src="{{asset('account/images/support.png')}}" alt="Generic placeholder image">
                </a>
                <span class="col-8 user-name row align-items-center text-bold text-white" style="text-transform: capitalize">
                                        Zigofly Support {{$open ?? 'not'}}
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
                    @if($message->sender_id == Auth::guard('web')->user()->id && empty($message->receiver_id))
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
    @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
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
            if (parseInt(@this.unreadMessages) > 0){
                $('.user-unread').text(@this.unreadMessages).removeClass('d-none')
            }else {
                $('.user-unread').addClass('d-none')
            }
        });

        $('.live-chat').on('click', function(e) {
            e.preventDefault();
            $('.btn-chat').trigger('click');
            @this.call('openChat')
        });
        Echo.channel('chat')
            .listen('.chat', (e)=>{
                console.log(e)
            @this.call('newMessage')
            })
        $('.btn-chat').on('click', function() {
            @this.call('openChat')
        });

        let min_height = '38';
        $('#chat-message').on('keydown', function (e) {
            if (e.which == 13 && !e.ctrlKey && !e.altKey && !e.shiftKey){
                e.preventDefault();
                @this.send()
            }else if(e.which == 13 &&( e.ctrlKey || e.altKey || e.shiftKey)){
                let v = $(this).val()
                $(this).val(v+'\n');
            }
            $(this).css( {
                'height': min_height+'px'
            });
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
    </script>
@endsection
