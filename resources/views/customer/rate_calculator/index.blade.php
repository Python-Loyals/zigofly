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
                        <nav class="breadcrumb bg-transparent p-0 py-md-3 mb-2 mb-md-0" style="font-size: 14px;">
                            <a class="breadcrumb-item" href="/" aria-label="Home">
                                <i class="fa fa-home"></i>
                            </a>
                            <a class="breadcrumb-item" href="#">Customer Dashboard</a>
                            <a class="breadcrumb-item" href="#">Rate Calculator</a>
                        </nav>
                    </div>
                    <div class="col-12">
                        <div class="overview-wraps" style="font-size: 14px;">
                            <p>
                                <span style="font-size: 16px;" class="pr-2">Welcome, {{ucfirst(explode(' ', request()->user()->name)[0])}}</span>&nbsp;
                                <i class="fas fa-map-marker-alt"></i> {{\App\County::find(request()->user()->county)->name}}, Kenya
                            </p>
                        </div>
                    </div>
                </div>

                @include('partials.customer.boxes')

                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-7 px-3">
                                <form method="POST" id="calculate-form" class="border rounded-10 shadow p-2">
                                    @csrf
                                    <div class="form-row mt-2">
                                        <div class="col-5 mt-auto mb-auto" style="font-size: 15px">
                                            Where are you shipping from?
                                        </div>
                                        <div class="col-7">
                                            <select class="form-control w-75" name="from">
                                                <option value="US">US</option>
                                                <option value="UK">UK</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <p style="font-size: 15px">Package Dimensions</p>
                                    </div>

                                    <table class="table table-borderless" cellpadding="2">
                                        <tbody>
                                        <tr class="d-md-table-row d-none fs-14 text-center">
                                            <td class="my-label">Length (Inches)</td>
                                            <td class="my-label">Width (Inches)</td>
                                            <td class="my-label">Height (Inches)</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="d-table-row d-md-table-cell">
                                                <div class="form-row mt-2 mt-md-0">
                                                    <div class="col-4 d-md-none d-flex fs-13 mt-auto mb-auto">
                                                        Length (Inches):
                                                    </div>
                                                    <div class="col-8 col-md-12 col-lg-12">
                                                        <input type="text" name="name[]" class="form-control form-rounded w-100">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="d-table-row d-md-table-cell">
                                                <div class="form-row mt-2 mt-md-0">
                                                    <div class="col-4 d-md-none d-flex fs-13 mt-auto mb-auto">
                                                        Width (Inches):
                                                    </div>
                                                    <div class="col-8 col-md-12 col-lg-12">
                                                        <input type="text" name="link[]" class="form-control form-rounded w-100">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="d-table-row d-md-table-cell">
                                                <div class="form-row mt-2 mt-md-0">
                                                    <div class="col-5 d-md-none d-flex fs-13 mt-auto mb-auto">
                                                        Height (Inches):
                                                    </div>
                                                    <div class="col-7 col-md-12 col-lg-12">
                                                        <input type="text" name="quantity[]" class="form-control form-rounded w-100">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <table class="table table-borderless" cellpadding="2">
                                                <tbody>
                                                <tr class="d-md-table-row d-none fs-14 text-center">
                                                    <td class="my-label">Package Weight (Kgs)</td>
                                                </tr>
                                                <tr>
                                                    <td class="d-table-row d-md-table-cell">
                                                        <div class="form-row mt-2 mt-md-0">
                                                            <div class="col-5 d-md-none d-flex fs-12 mt-auto mb-auto">
                                                                Package Weight (Kgs):
                                                            </div>
                                                            <div class="col-7 col-md-12 col-lg-12">
                                                                <input type="text" name="options[]" class="form-control form-rounded w-100">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="col-md-4 mt-3 my-md-auto fs-14">
                                            <p>Actual Weight: </p>
                                            <p>Volumetric Weight:</p>
                                            <p>Chargeable Weight:</p>
                                        </div>
                                        <div class="col-md-4 mt-4 mt-md-auto mb-2 mx-3 mx-md-0">
                                            <p class="text-center">Cost in KES</p>
                                            <div class="">
                                                <button type="submit" class="btn btn-warning btn-block">0.00</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="col-md-4 mt-3 mt-md-0 px-3">
                                <form method="POST" id="quote-form" class="border rounded-10 shadow p-2">
                                    <div class="row my-1">
                                        <div class="col-12 text-center">
                                            <p style="font-size: 19px">Get a Quick Quote</p>
                                        </div>
                                    </div>
                                    @csrf
                                    <div class="form-row mt-2">
                                        <div class="col-5 fs-13 mt-auto mb-auto">
                                            Product Name:
                                        </div>
                                        <div class="col-7">
                                            <input type="text" name="name[]" class="form-control form-rounded w-100">
                                        </div>
                                    </div>

                                    <div class="form-row mt-2">
                                        <div class="col-5 fs-13 mt-auto mb-auto">
                                            Product Link:
                                        </div>
                                        <div class="col-7">
                                            <input type="text" name="link[]" class="form-control form-rounded w-100">
                                        </div>
                                    </div>

                                    <div class="form-row mt-2">
                                        <div class="col-5 fs-13 mt-auto mb-auto">
                                            Quantity:
                                        </div>
                                        <div class="col-7">
                                            <input type="text" name="quantity[]" class="form-control form-rounded w-100">
                                        </div>
                                    </div>

                                    <div class="form-row mt-2">
                                        <div class="col-5 fs-12 mt-auto mb-auto">
                                            Color/Size/Options:
                                        </div>
                                        <div class="col-7">
                                            <input type="text" name="options[]" class="form-control form-rounded w-100">
                                        </div>
{{--                                        <div class="col-2 d-flex mt-2 mt-md-auto mb-auto ml-auto">--}}
{{--                                            <button type="button" id="btn-add-row" class="btn ml-auto btn-outline-dark btn-default btn-circle">--}}
{{--                                                <i class="fa fa-plus"></i>--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
                                    </div>

                                    <div class="form-row mt-4">
                                        <div class="col-12 col-lg-8 col-md-8 text-right"></div>
                                        <div class="col-12 text-right px-5">
                                            <button type="submit" class="btn btn-warning btn-block">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                @include('partials.customer.popular_categories')

            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>
@endsection
