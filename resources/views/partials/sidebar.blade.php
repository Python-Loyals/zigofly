<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{asset('images/white-logo-300x90.png')}}" alt="Zigofly" />
        </a>
        <button class="hamburger hamburger--slider d-lg-none ml-2" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner bg-light"></span>
                    </span>
        </button>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="{{ request()->is('admin') || request()->is('admin#') ? 'active' : '' }}">
                    <a class="js-arrow" href="/">
                        <img alt="Dashboard" class="pr-1" width="30" height="30" src="{{asset('account/images/icon/tachometer.png')}}" />Dashboard
                    </a>
                </li>
                <li class="{{ request()->is('user/address') || request()->is('user/address*') ? 'active' : '' }}">
                    <a href="{{route('admin.users.address')}}">
                        <img alt="My Address" class="pr-1" width="30" height="30" src="{{asset('account/images/icon/pin.png')}}" />My Adress</a>
                </li>
                <li class="{{ request()->is('user/orders') || request()->is('user/orders*') ? 'active' : '' }}">
                    <a href="{{route('admin.users.orders')}}">
                        <img alt="My orders" class="pr-1" width="30" height="30" src="{{asset('account/images/icon/box.png')}}" />My Orders</a>
                </li>
                <li class="{{ request()->is('user/shipments') || request()->is('user/shipments*') ? 'active' : '' }}">
                    <a href="{{route('admin.users.shipments')}}">
                        <img alt="My Shipments" class="pr-1" width="30" height="30" src="{{asset('account/images/icon/aeroplane.png')}}" />My Shipments
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img alt="My Payments" class="pr-1" width="30" height="30" src="{{asset('account/images/icon/financial.png')}}" />My Payments
                    </a>
                </li>
                <li class="{{ request()->is('user/quotes') || request()->is('user/quotes*') ? 'active' : '' }}">
                    <a href="{{route('admin.users.quotes')}}">
                        <img alt="Quote" class="pr-1" width="30" height="30" src="{{asset('account/images/icon/contract.png')}}" />Get Quote
                    </a>
                </li>
                <li class="{{ request()->is('user/shop') || request()->is('user/shop*') ? 'active' : '' }}">
                    <a href="{{route('admin.shop')}}">
                        <img alt="Shopping Guide" class="pr-1" width="30" height="30" src="{{asset('account/images/icon/online-shopping.png')}}" />Shopping Guide
                    </a>
                </li>
                <li class="{{ request()->is('user/calculator') || request()->is('user/calculator*') ? 'active' : '' }}">
                    <a href="{{route('admin.users.calculator')}}">
                        <img alt="Rate Calculator" class="pr-1" width="30" height="30" src="{{asset('account/images/icon/calculator.png')}}" />Rate Calculator
                    </a>
                </li>
                <li>
                    <a href="#" class="live-chat">
                        <img alt="Chat" class="pr-1" width="30" height="30" src="{{asset('account/images/icon/chat.png')}}" />Live Chat
                    </a>
                </li>

                <li class="logout-sidebar pl-5">
                    <form action="{{route('logout')}}" method="post" id="logoutform">
                        @csrf
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                            <i class="fa fa-sign-out-alt"></i>{{ trans('global.logout') }}
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>
