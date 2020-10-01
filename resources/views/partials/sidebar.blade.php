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
                        <i class="fas fa-tachometer-alt"></i>Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.shop')}}" class="{{ request()->is('admin/shop') || request()->is('admin/shop*') ? 'active' : '' }}">
                        <i class="fas  fa-shopping-bag"></i>Shop Now
                    </a>
                </li>
                <li class="{{ request()->is('admin/address') || request()->is('admin/address*') ? 'active' : '' }}">
                    <a href="{{route('admin.users.address')}}">
                        <i class="fas fa-map-marker-alt"></i>My Adress</a>
                </li>
                <li>
                    <a href="orders.html">
                        <i class="fas fa-gift"></i>My Orders</a>
                </li>
                <li>
                    <a href="shipments.html">
                        <i class="fas fa-plane"></i>My Shipments
                    </a>
                </li>
                <li>
                    <a href="quote.html">
                        <i class="fas fa-edit"></i>Get Quote
                    </a>
                </li>
                <li>
                    <a href="#" class="live-chat">
                        <i class="fa  fa-comments"></i>Live Chat
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
