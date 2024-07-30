@extends('layouts.base')
@section('content')
    <section class="breadcrumb-section section-b-space" style="padding-top:20px;padding-bottom:20px;">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>Checkout</h3>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/">
                                    <i class="fas fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    @auth
    <!-- Cart Section Start -->
    <section class="section-b-space">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8">
                    <form class="needs-validation" method="POST" action="{{ route('cart.process') }}">
                        @csrf
                        <div id="billingAddress" class="row g-4">

                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <h3 class="mb-3 theme-color">Checkout</h3>
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" required class="form-control" id="name" name="name"
                                    placeholder="Enter Name" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" required class="form-control" id="email" name="email"
                                    placeholder="Enter Email" value="{{ Auth::user()->email }}">
                            </div>
                            <div class="col-md-12">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" required id="address" name="address"></textarea>

                            </div>
                            <div class="col-md-6">
                                <label for="kabupaten" class="form-label">Kabupaten</label>
                                <input type="text" required class="form-control" id="kabupaten" name="kabupaten"
                                    placeholder="kabupaten">
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" required class="form-control" id="phone" name="phone"
                                    placeholder="Enter Phone Number">
                            </div>

                        </div>


                        <hr class="my-lg-5 my-4">


                        <button class="btn btn-solid-default mt-4" type="submit">Order</button>
                    </form>
                </div>

                <div class="col-lg-4">
                    <div class="your-cart-box">
                        <h3 class="mb-3 d-flex text-capitalize">Your cart<span
                                class="badge bg-theme new-badge rounded-pill ms-auto bg-dark">{{ Cart::instance('cart')->content()->count() }}</span>
                        </h3>
                        <ul class="list-group mb-3">



                            <li class="list-group-item d-flex justify-content-between lh-condensed active">
                                <div class="text-dark">
                                    <h6 class="my-0">Tax</h6>
                                    <small></small>
                                </div>
                                <span>Rp.{{ Cart::instance('cart')->tax() }}</span>
                            </li>
                            <li class="list-group-item d-flex lh-condensed justify-content-between">
                                <span class="fw-bold">Total (IDR)</span>
                                <strong>Rp.{{ Cart::instance('cart')->total() }}</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endauth
@endsection
