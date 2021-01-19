<div id="sidebar" class="users p-chat-user showChat">
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

                @php($customers = \App\User::all())
                <div class="main-friend-list">
                    @forelse($customers as $key => $customer)
                        <div class="media userlist-box waves-effect waves-light" data-recipient="{{$customer->id}}"
                             data-profile="/account/uploads/avatar.png" data-username='{{$customer->name}}'
                             data-uid="{{Auth::user()->id}}">
                            <a class="media-left" href="#!">
                                <img class="media-object img-radius img-radius"
                                     src="/account/uploads/avatar.png" alt="Generic placeholder image ">
                            </a>

                            <div class="media-body">
                                <div class="chat-header">
                                    <span class="text-capitalize">
                                        <?= $customer->name ?>
                                    </span>
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


<div class="showChat_inner">
    <div class="media chat-inner-header row align-items-start mb-0 pb-3 pl-0 ml-0">
        <a class="back_chatBox">
            <i class="zmdi zmdi-chevron-right"></i>
        </a>
        <div class="w-100 row">
            <a class="media-left photo-table col-4 pr-0" href="#!">
                <img class="media-object img-cir m-t-5 bg-light" src="{{asset('account/images/support.png')}}" alt="Generic placeholder image">
            </a>
            <span class="col-8 user-name row align-items-center text-bold text-white" style="text-transform: capitalize"></span>
        </div>
    </div>
    <div class="main-friend-chat mt-2 pb-3" style="height: 72%!important;">

    </div>
    <div class="chat-reply-box pr-1">
        <form id="chat-form">
            <div class="right-icon-control">
                <div class="row">
                    <div class="col-9 px-0 ml-2">
                        <textarea name="message" id="chat-message" placeholder="Type message here..." rows="1"></textarea>
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
