@extends('layouts.customer.customer')
@section('styles')
    <link rel="stylesheet" href="{{asset('account/css/zigo.css')}}">
@endsection
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <nav class="breadcrumb bg-transparent">
                            <a class="breadcrumb-item" href="/" aria-label="Home">
                                <i class="fa fa-home"></i>
                            </a>
                            <a class="breadcrumb-item" href="#">Featured Cartegories</a>
                        </nav>
                    </div>

                </div>
                <hr>

                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="row">

                                <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                    <div class="card product-group" data-href="{{route('products.category.search', 'men')}}" >
                                        <div class="card-body">
                                            <div class="mx-auto d-block">
                                                <img class="rounded-circle mx-auto d-block" src="{{asset('account/images/covers/men1.jpg')}}" alt="Card image cap">
                                                <h5 class="text-sm-center mt-2 mb-1">Men Clothing</h5>
                                                <div class="cartegory-text">
                                                    Shop men Clothing from US and UK Stores</div>
                                            </div>
                                            <hr>
                                            <div class="text-sm-center">
                                                <a href="{{route('products.category.search', 'men')}}">
                                                    <button type="button" class="btn btn-outline-secondary">Shop now</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                    <div class="card product-group" data-href="{{route('products.category.search', 'women')}}">
                                        <div class="card-body">
                                            <div class="mx-auto d-block">
                                                <img class="rounded-circle mx-auto d-block" src="{{asset('account/images/covers/women1.jpeg')}}" alt="Card image cap">
                                                <h5 class="text-sm-center mt-2 mb-1">Women Clothing</h5>
                                                <div class="cartegory-text">
                                                    Shop women Clothing from US and UK Stores</div>
                                            </div>
                                            <hr>
                                            <div class="text-sm-center">
                                                <a href="{{route('products.category.search', 'women')}}">
                                                    <button type="button" class="btn btn-outline-secondary">Shop now</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                    <div class="card product-group" data-href="{{route('products.category.search', 'kids')}}">
                                        <div class="card-body">
                                            <div class="mx-auto d-block">
                                                <img class="rounded-circle mx-auto d-block" src="{{asset('account/images/covers/Baby  Kids & Moms.jpeg')}}" alt="Card image cap">
                                                <h5 class="text-sm-center mt-2 mb-1">Kids & Moms</h5>
                                                <div class="cartegory-text">
                                                    Shop Kids & Moms from US and UK Stores</div>
                                            </div>
                                            <hr>
                                            <div class="text-sm-center">
                                                <a href="{{route('products.category.search', 'kids')}}">
                                                    <button type="button" class="btn btn-outline-secondary">Shop now</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                    <div class="card product-group" data-href="{{route('products.category.search', 'beauty')}}">
                                        <div class="card-body">
                                            <div class="mx-auto d-block">
                                                <img class="rounded-circle mx-auto d-block" src="{{asset('account/images/covers/beauty1.jpg')}}" alt="Card image cap">
                                                <h5 class="text-sm-center mt-2 mb-1">Beauty</h5>
                                                <div class="cartegory-text">
                                                    Shop beauty from US and UK Stores</div>
                                            </div>
                                            <hr>
                                            <div class="text-sm-center">
                                                <a href="{{route('products.category.search', 'beauty')}}">
                                                    <button type="button" class="btn btn-outline-secondary">Shop now</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                    <div class="card product-group" data-href="{{route('products.category.search', 'fitness')}}">
                                        <div class="card-body">
                                            <div class="mx-auto d-block">
                                                <img class="rounded-circle mx-auto d-block" src="{{asset('account/images/covers/Sports & Fitness1.jpg')}}" alt="Card image cap">
                                                <h5 class="text-sm-center mt-2 mb-1">Sports & Fitness</h5>
                                                <div class="cartegory-text">
                                                    Shop Sports & Fitness from US and UK Stores</div>
                                            </div>
                                            <hr>
                                            <div class="text-sm-center">
                                                <a href="{{route('products.category.search', 'fitness')}}">
                                                    <button type="button" class="btn btn-outline-secondary">Shop now</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                    <div class="card product-group" data-href="{{route('products.category.search', 'electronics')}}">
                                        <div class="card-body">
                                            <div class="mx-auto d-block">
                                                <img class="rounded-circle mx-auto d-block" src="{{asset('account/images/covers/electronics1.jpeg')}}" alt="Card image cap">
                                                <h5 class="text-sm-center mt-2 mb-1">Electronics</h5>
                                                <div class="cartegory-text">
                                                    Shop electronics from US and UK Stores</div>
                                            </div>
                                            <hr>
                                            <div class="text-sm-center">
                                                <a href="{{route('products.category.search', 'electronics')}}">
                                                    <button type="button" class="btn btn-outline-secondary">Shop now</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                    <div class="card product-group" data-href="{{route('products.category.search', 'home garden')}}">
                                        <div class="card-body">
                                            <div class="mx-auto d-block">
                                                <img class="rounded-circle mx-auto d-block" src="{{asset('account/images/covers/Home & Garden.jpg')}}" alt="Card image cap">
                                                <h5 class="text-sm-center mt-2 mb-1">Home & Garden</h5>
                                                <div class="cartegory-text">
                                                    Shop Home & Garden from US and UK Stores</div>
                                            </div>
                                            <hr>
                                            <div class="text-sm-center">
                                                <a href="{{route('products.category.search', 'home garden')}}">
                                                    <button type="button" class="btn btn-outline-secondary">Shop now</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                    <div class="card product-group" data-href="{{route('products.category.search', 'office')}}">
                                        <div class="card-body">
                                            <div class="mx-auto d-block">
                                                <img class="rounded-circle mx-auto d-block" src="{{asset('account/images/covers/Office Supplies3.jpg')}}" alt="Card image cap">
                                                <h5 class="text-sm-center mt-2 mb-1">Office Supplies</h5>
                                                <div class="cartegory-text">
                                                    Shop Office Supplies from US and UK Stores</div>
                                            </div>
                                            <hr>
                                            <div class="text-sm-center">
                                                <a href="{{route('products.category.search', 'office')}}">
                                                    <button type="button" class="btn btn-outline-secondary">Shop now</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                    <div class="card product-group" data-href="{{route('products.category.search', 'gifts')}}">
                                        <div class="card-body">
                                            <div class="mx-auto d-block">
                                                <img class="rounded-circle mx-auto d-block" src="{{asset('account/images/covers/gifts2.jpg')}}" alt="Card image cap">
                                                <h5 class="text-sm-center mt-2 mb-1">Gifts</h5>
                                                <div class="cartegory-text">
                                                    Shop gifts from US and UK Stores</div>
                                            </div>
                                            <hr>
                                            <div class="text-sm-center">
                                                <a href="{{route('products.category.search', 'gifts')}}">
                                                    <button type="button" class="btn btn-outline-secondary">Shop now</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                    <div class="card product-group" data-href="{{route('products.category.search', 'car parts')}}">
                                        <div class="card-body">
                                            <div class="mx-auto d-block">
                                                <img class="rounded-circle mx-auto d-block" src="{{asset('account/images/covers/Car Parts1.jpg')}}" alt="Card image cap">
                                                <h5 class="text-sm-center mt-2 mb-1">Car Parts</h5>
                                                <div class="cartegory-text">
                                                    Shop Car Parts from US and UK Stores</div>
                                            </div>
                                            <hr>
                                            <div class="text-sm-center">
                                                <a href="{{route('products.category.search', 'car parts')}}">
                                                    <button type="button" class="btn btn-outline-secondary">Shop now</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                    <div class="card product-group" data-href="{{route('products.category.search', 'books')}}">
                                        <div class="card-body">
                                            <div class="mx-auto d-block">
                                                <img class="rounded-circle mx-auto d-block" src="{{asset('account/images/covers/books.jpg')}}" alt="Card image cap">
                                                <h5 class="text-sm-center mt-2 mb-1">Books</h5>
                                                <div class="cartegory-text">
                                                    Shop books from US and UK Stores</div>
                                            </div>
                                            <hr>
                                            <div class="text-sm-center">
                                                <a href="{{route('products.category.search', 'books')}}">
                                                    <button type="button" class="btn btn-outline-secondary">Shop now</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                                <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                    <div class="card product-group" data-href="{{route('products.category.search', 'mega stores')}}">
                                        <div class="card-body">
                                            <div class="mx-auto d-block">
                                                <img class="rounded-circle mx-auto d-block" src="{{asset('account/images/covers/mega store1.jpg')}}" alt="Card image cap">
                                                <h5 class="text-sm-center mt-2 mb-1">Mega Stores</h5>
                                                <div class="cartegory-text">
                                                    Shop Mega Stores from US and UK Stores</div>
                                            </div>
                                            <hr>
                                            <div class="text-sm-center">
                                                <a href="{{route('products.category.search', 'mega stores')}}">
                                                    <button type="button" class="btn btn-outline-secondary">Shop now</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
