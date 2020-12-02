@extends('layouts.customer.customer')
@section('content')
    <style type="text/css">
        .card:hover {
            box-shadow: 1px 8px 20px grey;
            -webkit-transition: box-shadow .1s ease-in;
            cursor: pointer;
        }

        .orange {
            background: #ff9f1a;
            color: #fff;
        }

        .checked {
            color: #ff9f1a;
        }
        .product-title{
            overflow: hidden!important;
            text-overflow: ellipsis!important;
            white-space: nowrap!important;
            color: #0066c0;
        }

        .product-title:hover{
            color: #ff3333;
        }

        .reviews{
            text-decoration: underline;
        }

        @media screen and (max-width: 576px) {
            .product-title{
                font-size: 14px;
                font-weight: 600;
            }

        }
    </style>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row m-b-10">
                    <div class="col-12">
                        <nav class="breadcrumb bg-transparent">
                            <a class="breadcrumb-item" href="/" aria-label="Home">
                                <i class="fa fa-home"></i>
                            </a>
                            <a class="breadcrumb-item" href="#">Categories</a>
                            @if(!empty(Request::route('search_term')))
                                <a class="breadcrumb-item" href="#">{{ucfirst(Request::route('search_term'))}}</a>
                            @endif
                        </nav>
                    </div>
                </div>

                <div class="row  m-b-30">
                    <div class="col-lg-12">
                        <div class="au-card recent-report p-md-l-">
                            <div class="au-card-inner">
                                <h3 class="title-2 m-b-40">Products</h3>
                                <div class="row">
                                    @if(isset($products))
                                        @foreach($products as $product)
                                            @php($product =(object) $product)

                                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                                <div class="card" data-href="{{route('product.show', $product->asin)}}">
                                                    <a href="{{route('product.show', $product->asin)}}">
                                                        <img class="card-img-top products product-image mx-auto lozad"
                                                             data-src="{{$product->thumbnail}}"
                                                             src="data:image/svg+xml;base64,PHN2ZyBpZD0iTGF5ZXJfMSIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgMjU2IDI1NiIgaGVpZ2h0PSI1MTIiIHZpZXdCb3g9IjAgMCAyNTYgMjU2IiB3aWR0aD0iNTEyIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxnIGlkPSJMYXllcl82Ij48Zz48cGF0aCBkPSJtMjMwLjggMTMyLjItMTguNS03NC40Yy0uMy0xLTEuMy0xLjctMi4zLTEuNWwtNTkuMiA5LjJjLTEgLjItMS44IDEuMS0xLjggMi4xbDUgNzYuNWMuMSAyLjMgMiA0IDQuMyAzLjloLjVsNjguOC0xMC43YzIuMi0uMyAzLjgtMi41IDMuNC00LjctLjItLjEtLjItLjMtLjItLjR6IiBmaWxsPSIjZmM2NTdlIi8+PHBhdGggZD0ibTE1My45IDE0NC4xLTUtNzYuNWMwLTEuMS43LTIgMS44LTIuMWwyNi44LTQuMi01LjgtMjMuMmMtLjQtMS4zLTEuNy0yLjItMy0ybC03OCAxMi4xYy0xLjQuMi0yLjQgMS40LTIuMyAyLjhsNi41IDEwMC43Yy4xIDMgMi43IDUuMyA1LjYgNS4yLjIgMCAuNCAwIC42LS4xbDU3LjUtOC45Yy0yLjIuMy00LjQtMS4yLTQuNy0zLjQuMS0uMSAwLS4yIDAtLjR6IiBmaWxsPSIjZjVjODRjIi8+PGNpcmNsZSBjeD0iMTA4LjkiIGN5PSIyMjkuNCIgZmlsbD0iIzI5NTg5ZiIgcj0iMTcuMyIvPjxjaXJjbGUgY3g9IjE5NC4zIiBjeT0iMjI5LjQiIGZpbGw9IiMyOTU4OWYiIHI9IjE3LjMiLz48cGF0aCBkPSJtMzguNCA1NC42Yy0uMiAwLS40IDAtLjYgMGwtMjkuNS0yLjljLTMuNS0uMy02LjEtMy40LTUuOC02LjlzMy40LTYuMSA2LjktNS44bDI5LjYgMi45YzMuNS4zIDYuMSAzLjUgNS43IDctLjMgMy4yLTMgNS43LTYuMyA1Ljd6IiBmaWxsPSIjZmM2NTdlIi8+PHBhdGggZD0ibTIxNS45IDIwMC4xaC0xMTkuOWwxMC40LTE1LjFjMy43LTUuNCA5LjQtOSAxNS45LTEwLjFsNzkuOS0xMy4xYzMuMy0uNSA1LjUtMy42IDUtNi45LS41LTIuOS0zLTUuMS02LTUuMWwtODMuMyAxMy42Yy04LjcgMi4xLTE2LjMgNy4zLTIxLjQgMTQuNmwtMTMuNyAyMGMtMi44IDQuMS0xLjggOS43IDIuMyAxMi41IDEuNSAxIDMuMyAxLjYgNS4xIDEuNmgxMjUuN2MzLjMgMCA2LTIuNyA2LTYgLjEtMy4zLTIuNi02LTYtNnoiIGZpbGw9IiNkYWU2ZjEiLz48Y2lyY2xlIGN4PSIxMDguOSIgY3k9IjIyOS40IiBmaWxsPSIjNTI5MGRiIiByPSI2LjIiLz48Y2lyY2xlIGN4PSIxOTQuMyIgY3k9IjIyOS40IiBmaWxsPSIjNTI5MGRiIiByPSI2LjIiLz48cGF0aCBkPSJtMjUzLjIgMTU4LjdoLTIuMXYtMi4xYzAtMS41LTEuMy0yLjgtMi44LTIuOHMtMi44IDEuMy0yLjggMi44djIuMWgtMi4xYy0xLjUgMC0yLjggMS4zLTIuOCAyLjhzMS4zIDIuOCAyLjggMi44aDIuMXYyLjFjMCAxLjUgMS4zIDIuOCAyLjggMi44czIuOC0xLjMgMi44LTIuOHYtMi4xaDIuMWMxLjUgMCAyLjgtMS4zIDIuOC0yLjhzLTEuMy0yLjgtMi44LTIuOHoiIGZpbGw9IiM3MGQ2ZjkiLz48cGF0aCBkPSJtODguMyAzMC41Yy00LS43LTcuMS0zLjgtNy45LTcuNyAwLS4xLS4xLS4yLS4yLS4xLS4xIDAtLjEuMS0uMS4xLS44IDQtMy45IDctNy45IDcuNy0uMSAwLS4yLjEtLjEuMiAwIC4xLjEuMS4xLjEgNCAuNyA3LjEgMy44IDcuOSA3LjcgMCAuMS4xLjIuMi4xLjEgMCAuMS0uMS4xLS4xLjgtNCAzLjktNyA3LjktNy43LjEgMCAuMi0uMS4xLS4yIDAtLjEgMC0uMS0uMS0uMXoiIGZpbGw9IiNmNWM4NGMiLz48Y2lyY2xlIGN4PSI2NCIgY3k9IjUyLjgiIGZpbGw9IiNmYzY1N2UiIHI9IjMiLz48Y2lyY2xlIGN4PSI1NyIgY3k9IjEzOS44IiBmaWxsPSIjODdkMTQ3IiByPSIzIi8+PGNpcmNsZSBjeD0iMjM4IiBjeT0iMTgwLjgiIGZpbGw9IiNmNWM4NGMiIHI9IjMiLz48cGF0aCBkPSJtOCA1NC4yIDI5LjUgMi44Yy41LjEgMS4xLjEgMS42IDBsNDMuOSAxMDAuN2MzLjIgNy40IDEwLjkgMTEuOSAxOC45IDEwLjktMi45IDIuMy01LjQgNS03LjUgOC4xbC0xMy43IDE5LjhjLTMuNiA1LjItMi4zIDEyLjQgMyAxNiAxLjkgMS4zIDQuMiAyIDYuNSAyaDUuNWMtOC4yIDcuMi04LjkgMTkuNy0xLjcgMjcuOXMxOS43IDguOSAyNy45IDEuNyA4LjktMTkuNyAxLjctMjcuOWMtLjUtLjYtMS4xLTEuMi0xLjctMS43aDU5LjJjLTguMiA3LjItOC45IDE5LjctMS43IDI3LjlzMTkuNyA4LjkgMjcuOSAxLjcgOC45LTE5LjcgMS43LTI3LjljLS41LS42LTEuMS0xLjItMS43LTEuN2g4LjVjNC43IDAgOC41LTMuOCA4LjUtOC41cy0zLjgtOC41LTguNS04LjVoLTExNWw3LjctMTEuMWMzLjMtNC44IDguNS04LjEgMTQuMi05bDc5LjktMTMuMWM0LjYtLjggNy44LTUuMSA3LTkuOC0uMi0xLjItLjYtMi4zLTEuMy0zLjNsMjMuMi0zLjhjNS4yLS44IDktNS4zIDktMTAuNnYtNTkuNWMwLTQuNy0zLjgtOC40LTguNC04LjQtLjEgMC0uMiAwLS4yIDBsLTE0LjMuNC0zLTEyLjJjLS42LTIuMi0yLjgtMy43LTUuMS0zLjNsLTYuMS45LS4yLTEuM2MtMi0xMi45LTE0LjEtMjEuOC0yNy0xOS44LTEuNC4yLTIuNy42LTQuMSAxLTEuMS0uOC0yLjUtMS4yLTMuOS0xbC04LjggMS40LS40LTIuNWMtMi41LTE2LjUtMTguMS0yNy44LTM0LjYtMjUuMnMtMjcuOCAxOC4xLTI1LjMgMzQuNmwuNCAyLjUtOS4xIDEuNGMtMi42LjQtNC42IDIuOC00LjQgNS40bDEuNCAyMS42LTM1LjQgMS04LjEtMTguNWMzLjktMyA0LjYtOC42IDEuNi0xMi41LTEuNS0xLjktMy43LTMuMi02LjItMy40bC0yOS42LTIuOGMtNC45LS41LTkuMiAzLjEtOS43IDhzMy4xIDkuMiA4IDkuNnptODcuNiA2OS4zLTIuNi00MC4yIDI5LjYgNjcuOC0xNCAyLjJ6bTcuOCAzMC42LTIuNi40Yy0xLjYuMi0zLjEtLjgtMy4zLTIuNCAwLS4xIDAtLjMgMC0uNGwtLjktMTMuNHptNTgtOTQuMWMtMS4yLTcuNCAyLjItMTQuNyA4LjUtMTguN2w0LjUgMTgtMTIuOCAyem01MC4xIDE0LjQgNS40IDEyLjQgMTEuNCA0NS45di4xYy4yLjktLjMgMS44LTEuMSAyLS4xIDAtLjEgMC0uMiAwbC0zLjkuNi0yNi40LTYwLjZ6bS0yMC4xLjYgMjYuNyA2MS4zLTE0IDIuMi0yNy41LTYzem0xNi4xIDcxLjMtMS40LTMuMiAxNC0yLjIgMS4zIDMuMXptLTM4LjEgNi4zLTEuNS0zLjUgMTQtMi4yIDEuNSAzLjR6bS0zLjUtOC4yLTExLTI1LjMtMi42LTQwLjMgMjcuNiA2My41em0tNy42IDEuMWMtLjkuMS0xLjctLjUtMS44LTEuNCAwLS4xIDAtLjIgMC0uMmwtLjctMTAuMiA1IDExLjR6bTQuNSA0LjQgMS41IDMuNS0xMy45IDIuMy0xLjYtMy42em0tMTcuNSA2LjYtMTMuOSAyLjMtMS42LTMuOCAxNC0yLjJ6bTQzLjItNy0xLjUtMy4zIDE0LTIuMiAxLjQgMy4yem0tMTcuMy03NCAyNy43IDYzLjctMTQgMi4yLTI4LjUtNjUuNXptLTE5LjUtNC40LS4yLTMuMiA2LS45LjYgMy45em0tMi44IDM0LjQtMTIuNi0yOSAxMC43LS4zem0tMTgtMjguOSAxOSA0My42IDEuNiAyNGMwIC44LjIgMS41LjUgMi4zbC01LjIuOC0zMC43LTcwLjN6bS0yMC4yLjYgMzAuOSA3MC45LTE0IDIuMi0zMS42LTcyLjd6bTEzLjkgNzguNiAxLjcgMy44LTEzLjkgMi4zLTEuNy0zLjl6bS0uOSA3My42YzAgOC4yLTYuNiAxNC44LTE0LjggMTQuOHMtMTQuOC02LjYtMTQuOC0xNC44IDYuNi0xNC44IDE0LjgtMTQuOCAxNC44IDYuNiAxNC44IDE0Ljh6bTg1LjQgMGMwIDguMi02LjYgMTQuOC0xNC44IDE0LjhzLTE0LjgtNi42LTE0LjgtMTQuOCA2LjYtMTQuOCAxNC44LTE0LjggMTQuOCA2LjYgMTQuOCAxNC44em0tNC40LTc0LjFjLjMgMS45LTEgMy43LTIuOSA0bC03OS45IDEzLjFjLTcuMSAxLjItMTMuNCA1LjItMTcuNSAxMS4xbC0xMC40IDE1LjJjLS44IDEuMS0uNSAyLjcuNiAzLjUuNC4zLjkuNCAxLjQuNGgxMTkuOWMxLjkgMCAzLjUgMS42IDMuNSAzLjVzLTEuNiAzLjUtMy41IDMuNWgtMTI1LjZjLTMuNiAwLTYuNS0yLjktNi41LTYuNSAwLTEuMy40LTIuNiAxLjItMy43bDEzLjctMTkuOGM0LjctNi44IDExLjgtMTEuNyAxOS45LTEzLjZsODMtMTMuNmMxLjUuMSAyLjkgMS4zIDMuMSAyLjl6bTI2LjEtMTIuOC00LjIuNy0xLjMtMyAyLjYtLjRjMy42LS42IDYuMS00IDUuNS03LjYgMC0uMi0uMS0uNS0uMS0uN2wtNC4zLTE3LjEgNi43IDE1LjR2Ny4xYy0uMSAyLjgtMi4xIDUuMi00LjkgNS42em0xLjMtNjguNmMxLjktLjEgMy41IDEuNCAzLjUgMy4zdi4xIDQwbC0xMy45LTMyLTIuNy0xMXptLTIyLjEtMTUuMSAyLjYgMTAuNi00OS41IDEuMy0uNy00LjYgMzYuOS01LjcuOCA1LjFjLjIgMS40IDEuNSAyLjMgMi45IDIuMXMyLjMtMS41IDIuMS0yLjlsLS44LTUuMXptLTMzLTIwLjJjMTAuMi0xLjYgMTkuNyA1LjQgMjEuMyAxNS42bC4yIDEuMy0xOS4yIDMtNC44LTE5LjNjLjktLjMgMS43LS41IDIuNS0uNnptLTEyLjkuOGMtMS4yIDEuMS0yLjQgMi4zLTMuNCAzLjdsLS41LTMuMXptLTYwLjEgMS44Yy0yLjItMTMuOCA3LjItMjYuOSAyMS4xLTI5LjFzMjYuOSA3LjIgMjkuMSAyMS4xdi4ybC40IDIuNS01MC4yIDcuOHptLTEyLjkgOS42IDkuMS0xLjQgMS4yIDcuNWMuNSAzLjMgNS40IDIuNSA0LjktLjhsLTEuMi03LjUgNTAuMi03LjggMS4yIDcuNWMuMS42LjQgMS4xLjkgMS41LTEuMiAzLjUtMS41IDcuMy0uOSAxMWwuMiAxLjMtNi4zIDFjLTIuMy40LTQgMi40LTMuOSA0LjhsLjIgMy40LTU0LjQgMS41LTEuNC0yMS44YzAtLjEuMS0uMi4yLS4yem0tMS40IDU5LjItMTMuOS0zMS45IDExLjgtLjN6bS0xOS4zLTMxLjcgMjAuMiA0Ni41IDEuOCAyNy4yYy4yIDQuNCAzLjkgNy44IDguMyA3LjYuMyAwIC42IDAgLjktLjFsMy45LS42IDEuNyA0LTUuMi45Yy02IDEtMTEuOS0yLjItMTQuNC03LjhsLTMzLjUtNzcuM3ptLTYxLjItMzYuOCAyOS41IDIuOGMyLjEuMiAzLjcgMi4xIDMuNSA0LjJzLTIuMSAzLjctNC4yIDMuNWwtMjkuNS0yLjdjLTIuMS0uMi0zLjctMi4xLTMuNS00LjMuMi0yLjEgMi4xLTMuNyA0LjItMy41eiIvPjxwYXRoIGQ9Im0xMDguOSAyMzguMWM0LjggMCA4LjctMy45IDguNy04LjdzLTMuOS04LjctOC43LTguNy04LjcgMy45LTguNyA4LjcgMy45IDguNyA4LjcgOC43em0wLTEyLjRjMi4xIDAgMy43IDEuNyAzLjcgMy43cy0xLjcgMy43LTMuNyAzLjdjLTIuMSAwLTMuNy0xLjctMy43LTMuNyAwLTIuMSAxLjctMy43IDMuNy0zLjd6Ii8+PHBhdGggZD0ibTE5NC4zIDIzOC4xYzQuOCAwIDguNy0zLjkgOC43LTguN3MtMy45LTguNy04LjctOC43LTguNyAzLjktOC43IDguN2MwIDQuOCAzLjkgOC43IDguNyA4Ljd6bTAtMTIuNGMyLjEgMCAzLjcgMS43IDMuNyAzLjcgMCAyLjEtMS43IDMuNy0zLjcgMy43LTIuMSAwLTMuNy0xLjctMy43LTMuNyAwLTIuMSAxLjctMy43IDMuNy0zLjd6Ii8+PC9nPjwvZz48L3N2Zz4="
                                                              alt="iPhone X">
                                                    </a>
                                                    <div class="card-body">
                                                        <a href="{{route('product.show', $product->asin)}}" class="w-100 card-title product-title">{{$product->title}}</a>
                                                        <div class="rating">
                                                            <div class="stars">
                                                                @php($rating = (int) $product->reviews['rating'])
                                                                @for($i = 0; $i < 5; $i++)
                                                                    <span class="fa fa-star {{$i < $rating ? 'checked': ''}}"></span>
                                                                @endfor

                                                                <span class="small reviews pl-2"> ({{$product->reviews['total_reviews']}})</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 col-lg-12">
                                                                <div class="price text-success">
                                                                    <h5 class="mt-4 ml-1">$ {{$product->price['current_price']}}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-12">
                                                                <a href="{{route('product.show', $product->asin)}}" class="btn btn-block orange mt-3 text-light">View Details</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- */product -->
                                        @endforeach
                                    @endif
                                </div>
                                <div class="row float-right mr-3">
                                    {{$products->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
