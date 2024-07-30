@extends('layouts.base')
@section('content')
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif

    <section class="pt-0 poster-section">
        <div class="poster-image slider-for custome-arrow classic-arrow">
            <div>
                <img src="assets/images/furniture-images/poster/banner.png"   class="img-fluid blur-up lazyload" alt="">
            </div>

        </div>


        <div class="left-side-contain">
            <div class="banner-left">
                <h1>New Latest <span>Computer</span></h1>
                <p>BUY ONE GET ONE <span class="theme-color">Mouse</span></p>
            </div>
        </div>

    </section>



    <!-- category section start -->
    <section class="category-section ratio_40">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title title-2 text-center">
                        <h2>Our Category</h2>
                        <h5 class="text-color">Our collection</h5>
                    </div>
                </div>
            </div>
            <div class="row gy-3">
                <div class="col-xxl-2 col-lg-3">
                    <div class="category-wrap category-padding category-block theme-bg-color">
                        <div>
                            <h2 class="light-text">Top</h2>
                            <h2 class="top-spacing">Our Top</h2>
                            <span>Categories</span>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-10 col-lg-9">
                    <div class="category-wrapper category-slider1 white-arrow category-arrow">
                        <div>
                            <a href="{{ route('shop.index',['categories'=>1]) }}" class="category-wrap category-padding">
                                <img src="assets/images/fashion/category/1-c.png" class="bg-img blur-up lazyload"
                                    alt="category image">
                                <div class="category-content category-text-1">
                                    <h3 class="theme-color">Laptop</h3>
                                    <span class="text-dark">Category</span>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('shop.index',['categories'=>2]) }}" class="category-wrap category-padding">
                                <img src="assets/images/fashion/category/2-c.png" class="bg-img blur-up lazyload"
                                    alt="category image">
                                <div class="category-content category-text-1">
                                    <h3 class="theme-color">Computer</h3>
                                    <span class="text-dark">Category</span>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('shop.index',['categories'=>3]) }}" class="category-wrap category-padding">
                                <img src="assets/images/fashion/category/3-c.png" class="bg-img blur-up lazyload"
                                    alt="category image">
                                <div class="category-content category-text-1">
                                    <h3 class="theme-color">Accessoris</h3>
                                    <span class="text-dark">Category</span>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('shop.index',['categories'=>4]) }}" class="category-wrap category-padding">
                                <img src="assets/images/fashion/category/4-c.png" class="bg-img blur-up lazyload"
                                    alt="category image">
                                <div class="category-content category-text-1">
                                    <h3 class="theme-color">Mobile</h3>
                                    <span class="text-dark">Category</span>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('shop.index',['categories'=>5]) }}" class="category-wrap category-padding">
                                <img src="assets/images/fashion/category/5-c.png" class="bg-img blur-up lazyload"
                                    alt="category image">
                                <div class="category-content category-text-1">
                                    <h3 class="theme-color">Software</h3>
                                    <span class="text-dark">Category</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- category section end -->

     <section class="ratio_asos overflow-hidden">
        <div class="container p-sm-0">
            <div class="row m-0">
                <div class="col-12 p-0">
                    <div class="title-3 text-center">
                        <h2>Product</h2>
                        <h5 class="theme-color">Our Collection</h5>
                    </div>
                </div>
            </div>
            <style>
                .r-price {
                    display: flex;
                    flex-direction: row;
                    gap: 20px;
                }

                .r-price .main-price {
                    width: 100%;
                }

                .r-price .rating {
                    padding-left: auto;
                }

                .product-style-3.product-style-chair .product-title {
                    text-align: left;
                    width: 100%;
                }

                @media (max-width:600px) {

                    .product-box p,
                    .product-box a {
                        text-align: left;
                    }

                    .product-style-3.product-style-chair .main-price {
                        text-align: right !important;
                    }
                }
            </style>
            <div class="row g-sm-4 g-3">
                @foreach ($products as $product)

                <div class="col-xl-2 col-lg-2 col-6">
                    <div class="product-box">
                        <div class="img-wrapper">
                            <a href="{{ route('shop.product.detail',['slug'=>$product->slug]) }}">
                                <img src="{{ asset('assets/images/product/main-pic') }}/{{ $product->image }}"
                                    class="w-100 bg-img blur-up lazyload" alt="">
                            </a>
                            <div class="circle-shape"></div>
                            <span class="background-text">{{ $product->category->name }}</span>
                            <div class="label-block">
                                <span class="label label-theme">new</span>
                            </div>
                            @if (Route::has('login'))
                                @auth
                                    @if (Auth::user()->role === 'usr')
                                        <div class="cart-wrap">
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)" class="addtocart-btn" onclick="event.preventDefault();document.getElementById('addtocart{{ $product->id }}').submit();">
                                                        <i data-feather="shopping-cart"></i>
                                                    </a>
                                                    <form id="addtocart{{ $product->id }}" method="post"
                                                        action="{{ route('cart.store') }}">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                                        <input type="hidden" name="quantity" id="qty" value="1">
                                                        @auth
                                                        <input type="hidden" name="user" id="user" value="{{ Auth::user()->id }}">
                                                        @endauth
                                                    </form>
                                                </li>
                                                <li>
                                                    <a href="{{ route('shop.product.detail',['slug'=>$product->slug]) }}">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    @else
                                        <div class="cart-wrap">
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)" class="addtocart-btn">
                                                        <i data-feather="shopping-cart"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('shop.product.detail',['slug'=>$product->slug]) }}">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                    @endif
                            @else
                                <div class="cart-wrap">
                                    <ul>
                                        <li>
                                            <a href="{{ route('login',['message' => 'Login First']) }}">
                                                <i data-feather="shopping-cart"></i>
                                            </a>

                                        </li>
                                        <li>
                                            <a href="{{ route('shop.product.detail',['slug'=>$product->slug]) }}">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                @endauth
                            @endif
                        </div>
                        <div class="product-style-3 product-style-chair">
                            <div class="product-title d-block mb-0">
                                <div class="r-price">
                                    <div class="theme-color text-sm">Rp.{{ number_format($product->price, 0, ' ', '.') }}</div>

                                </div>
                                <p class="font-light mb-sm-2 mb-0">{{ $product->category->name }}</p>
                                <a href="product/details.html" class="font-default">
                                    <h5>{{ $product->name }}</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <style>
        .products-c .bg-size {
            background-position: center 0 !important;
        }
    </style>



@endsection
