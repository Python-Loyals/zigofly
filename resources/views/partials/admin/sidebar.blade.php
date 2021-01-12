<!-- MENU SIDEBAR-->

<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{asset('images/white-logo-300x90.png')}}" alt="{{trans('panel.site_title')}}" />
        </a>
        <button class="hamburger hamburger--slider d-md-none ml-2" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner bg-light"></span>
                    </span>
        </button>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="active has-sub">
                    <a class="js-arrow" href="{{route('admin.home')}}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard
                    </a>
                <li>
                    <a href="{{route('admin.customers.index')}}">
                        <img alt="Shipments" class="pr-1" width="27" height="27"
                             src="{{asset('admin/images/icon/group.png')}}">Customers
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img alt="Shipments" class="pr-1" width="30" height="30"
                             src="{{asset('admin/images/icon/bill.png')}}">Invoices</a>
                </li>
                <li>
                    <a href="#">
                        <img alt="Shipments" class="pr-1" width="30" height="30"
                             src="{{asset('admin/images/icon/notebook.svg')}}">Estimates
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img alt="Shipments" class="pr-1" width="30" height="30"
                             src="{{asset('admin/images/icon/receipt.png')}}">Bills
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.orders.index')}}">
                        <img alt="Orders" class="pr-1" width="25" height="25"
                             src="{{asset('admin/images/icon/cart.svg')}}">Orders
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img alt="Shipments" class="pr-1" width="30" height="30"
                             src="{{asset('admin/images/icon/goods.png')}}">Shipments
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img alt="Shipments" class="pr-1" width="27" height="27"
                             src="{{asset('admin/images/icon/email.png')}}">Messages
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img alt="Shipments" class="pr-1" width="27" height="27"
                             src="{{asset('admin/images/icon/group.png')}}">Staff Chat
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img alt="Shipments" class="pr-1" width="30" height="30"
                             src="{{asset('admin/images/icon/report.png')}}">Reports
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img alt="Shipments" class="pr-1" width="30" height="30"
                             src="{{asset('admin/images/icon/settings.png')}}">Settings
                    </a>
                </li>

                <li class="logout-sidebar pl-5">
                    <form action="{{route('admin.logout')}}" method="post" id="logoutform">
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
<!-- END MENU SIDEBAR-->
