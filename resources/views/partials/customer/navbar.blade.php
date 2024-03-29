<header class="header-desktop">
    <div class="section__content section__content--p30 pt-5">
        <div class="container-fluid">
            <div class="header-wrap">
                <div class="header-button w-100">
                    <button class="hamburger hamburger--slider d-lg-none" type="button">
                        <span class="hamburger-box">
                            <span class="hamburger-inner bg-light"></span>
                        </span>
                    </button>
                    <form class="form-header d-sm-flex text-center ml-5 d-none search-form" action="{{route('products.search')}}" method="GET">
                        <input class="au-input au-input--xl" type="text" name="q" placeholder="Search for any product..." />
                        <button class="p-l-10 au-btn-search" type="submit" aria-label="search">
                            <i class="zmdi zmdi-search fs-23 text-light"></i>
                        </button>
                    </form>
                    <div class="noti-wrap ml-auto mr-4">
                        <div class="noti__item js-item-menu">
                            <i class="zmdi zmdi-notifications"></i>
                            <span class="quantity">3</span>
                            <div class="notifi-dropdown js-dropdown">
                                <div class="notifi__title">
                                    <p>You have 3 Notifications</p>
                                </div>
                                <div class="notifi__item">
                                    <div class="bg-c1 img-cir img-40">
                                        <i class="zmdi zmdi-email-open"></i>
                                    </div>
                                    <div class="content">
                                        <p>You got a email notification</p>
                                        <span class="date">April 12, 2018 06:50</span>
                                    </div>
                                </div>
                                <div class="notifi__item">
                                    <div class="bg-c2 img-cir img-40">
                                        <i class="zmdi zmdi-account-box"></i>
                                    </div>
                                    <div class="content">
                                        <p>Your account has been blocked</p>
                                        <span class="date">April 12, 2018 06:50</span>
                                    </div>
                                </div>
                                <div class="notifi__item">
                                    <div class="bg-c3 img-cir img-40">
                                        <i class="zmdi zmdi-file-text"></i>
                                    </div>
                                    <div class="content">
                                        <p>You got a new file</p>
                                        <span class="date">April 12, 2018 06:50</span>
                                    </div>
                                </div>
                                <div class="notifi__footer">
                                    <a href="#">{{trans('global.all_notifications')}}</a>
                                </div>
                            </div>
                        </div>

                        <div class="noti__item js-item-menu">
                            <i class="zmdi zmdi-shopping-cart"></i>
                            <span class="quantity cart-count">{{Cart::count()}}</span>
                            <div class="mess-dropdown js-dropdown">
                                <!------------------------------------>
                                <div class="mess__title show-on-add {{Cart::count() > 0 ? '': 'd-none'}}">
                                    <p>You have <span class="cart-count">{{Cart::count()}}</span> products in the cart</p>
                                </div>
                                <div class="cart-body" data-scrollbar>
                                    @if(Cart::count() > 0)
                                        @foreach(Cart::content() as $item)

                                            <div class="mess__item">
                                                <div class="image img-cir img-40">
                                                    <img src="{{$item->model->images[0]->link}}" class="img-40 img-thumbnail" alt="SAMSUNG GALAXY" />
                                                </div>
                                                <div class="content">
                                                    <h6  class="cart-item-title">{{$item->model->title}}</h6>
                                                    <span class="time">{{$item->qty}} X ${{$item->model->price}}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                        @else
                                        <div class="card" style="margin-bottom: 30px;border: 0;">
                                            <div class="card-body" style="background: transparent; overflow-x: hidden;">
                                                <div class="col-sm-12 empty-cart-cls text-center">
                                                    <img src="https://cdn.dribbble.com/users/204955/screenshots/4930541/emptycart.png" width="180" class="img-fluid mb-1 mr-3 empty">
                                                    <h3><strong>Your Cart is Empty</strong></h3>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="mess__footer show-on-add px-1 bg-dark {{Cart::count() > 0 ? '': 'd-none'}}">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="{{route('cart.index')}}" class="btn py-3 text-light no-hover">
                                                {{trans('global.view_cart')}}</a>
                                        </div>
                                        <div class="col-6 border-white border-left">
                                            <a href="{{route('cart.checkout')}}" class="btn py-3 text-light no-hover">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            @php
                                $fname = '';
                                if (isset(auth()->user()->name)){
                                    $fname = ucfirst(explode(' ', auth()->user()->name)[0]);
                                }
                            @endphp

                            <div class="image d-md-block d-none">
                                <img src="{{count(auth()->user()->profile) > 0 ? auth()->user()->profile[0]->thumbnail : asset('images/user.png')}}" alt="{{$fname}}" />
                            </div>
                            <div class="content m-sm-l-0">
                                <a class="js-acc-btn" href="#">{{$fname}}</a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <a href="#">
                                            <img src="{{count(auth()->user()->profile) > 0 ? auth()->user()->profile[0]->preview : asset('images/user.png')}}" alt="{{auth()->user()->name}}" />
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                            <a href="#">{{auth()->user()->name ?? ''}}</a>
                                        </h5>
                                        <span class="email">{{auth()->user()->email}}</span>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="{{route('customer.profile.index')}}">
                                            <i class="zmdi zmdi-account"></i>Account</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-settings"></i>Setting</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-money-box"></i>Billing</a>
                                    </div>
                                </div>
                                <div class="account-dropdown__footer">
                                    <form action="{{route('logout')}}" method="post" id="logoutform">
                                        @csrf
                                        <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                            <i class="fa fa-sign-out-alt"></i>{{ trans('global.logout') }}
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
