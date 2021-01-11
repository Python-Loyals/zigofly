<div class="row m-t-25">
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c1">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="row">
                        <h2 class="tex-2 align-items-center mx-auto pl-2 text-light" style="font-size: 22px;">
                            USD 2,000
                        </h2>
                        <div class="icon ml-auto">
                            <img src="images/icon/sales.svg" alt="US" width="50" height="75">
                        </div>
                    </div>
                    <div class="text text-uppercase">
                        <span>Revenues</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c2">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="row">
                        <h2 class="tex-2 align-items-center mx-auto pl-3 text-light">
                            200
                        </h2>
                        <div class="icon ml-auto">
                            <img src="images/icon/notebook.svg" alt="US" width="50" height="75">
                        </div>
                    </div>
                    <div class="text text-uppercase">
                        <span>Estimates</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c3">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="row">
                        <h2 class="tex-2 align-items-center mx-auto pl-3 text-light">
                            {{count(\App\Order::all()) ?? '0'}}
                        </h2>
                        <div class="icon ml-auto">
                            <img src="images/icon/cart.svg" alt="US" width="50" height="75">
                        </div>
                    </div>
                    <div class="text">
                        <span>ORDERS</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c4" data-href="{{route('admin.customers.index')}}">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="row">
                        <h2 class="tex-2 align-items-center mx-auto pl-3 text-light">
                            {{count(\App\User::all())}}
                        </h2>
                        <div class="icon ml-auto">
                            <img src="images/icon/group.png" alt="US" width="50" height="75">
                        </div>
                    </div>
                    <div class="text">
                        <span>Customers</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
