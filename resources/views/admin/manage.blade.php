@extends('layouts.base')
@section('content')

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <!-- Breadcrumb section start -->
    <section class="breadcrumb-section section-b-space">
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
                    <h3>Manage Product</h3>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('app.index') }}">
                                    <i class="fas fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Product</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb section end -->

    <!-- user dashboard section start -->
    <section class="section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <ul class="nav nav-tabs custome-nav-tabs flex-column category-option" id="myTab">
                        <li class="nav-item mb-2">
                            <button class="nav-link font-light active" id="tab" data-bs-toggle="tab" data-bs-target="#dash" type="button"><i class="fas fa-angle-right"></i>Products</button>
                        </li>

                        <li class="nav-item mb-2">
                            <button class="nav-link font-light" id="1-tab" data-bs-toggle="tab" data-bs-target="#order" type="button"><i class="fas fa-angle-right"></i>Brands</button>
                        </li>

                        <li class="nav-item mb-2">
                            <button class="nav-link font-light" id="2-tab" data-bs-toggle="tab" data-bs-target="#wishlist" type="button"><i class="fas fa-angle-right"></i>Categories</button>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-10">
                    <div class="filter-button dash-filter dashboard">
                        <button class="btn btn-solid-default btn-sm fw-bold filter-btn">Show Menu</button>
                    </div>

                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade table-dashboard dashboard wish-list-section show active" id="dash">
                            <div class="box-head mb-3">
                                <h3>Products</h3>
                            </div>
                            <div class="product-buttons">
                                <a href="{{ route('admin.create') }}" class="btn btn-solid hover-solid btn-animation">
                                    <i class="fas fa-plus-square"></i>
                                    <span>Add Product</span>
                                </a>
                            </div>
                            <div class="table-responsive">
                                <table class="table cart-table">
                                    <thead>
                                        <tr class="table-head">
                                            <th scope="col">Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Stock</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Brand</th>
                                            <th scope="col" colspan="2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                        <tr>
                                            <td>
                                                <a href="details.php">
                                                    <img src="{{ asset('assets/images/product/main-pic') }}/{{ $product->image }}" class="blur-up lazyload" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <p class="fs-6 m-0">{{ \Illuminate\Support\Str::limit($product->name, 10, $end='...') }}</p>
                                            </td>
                                            <td>
                                                <p class="fs-6 m-0">{{ \Illuminate\Support\Str::limit($product->description, 30, $end='...') }}</p>
                                            </td>
                                            <td>
                                                <p class="theme-color fs-6">Rp.{{ number_format($product->price, 0, ' ', '.') }}</p>
                                            </td>
                                            <td>
                                                <p class="fs-6 m-0">{{ $product->quantity }}</p>
                                            </td>
                                            <td>
                                                <p class="fs-6 m-0">{{ $product->category->name }}</p>
                                            </td>
                                            <td>
                                                <p class="fs-6 m-0">{{ $product->brand->name }}</p>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.delete', ['id_product' => $product->id]) }}" onclick="return confirm('Apakah anda yakin ingin menghapus?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade table-dashboard dashboard wish-list-section" id="order">
                            <div class="box-head mb-3">
                                <h3>Brands</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table cart-table">
                                    <thead>
                                        <tr class="table-head">
                                            <th scope="col">image</th>
                                            <th scope="col">Brand Name</th>
                                            <th scope="col">slug</th>
                                            <th scope="col" colspan="2">action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brands as $brand)
                                        <tr>
                                            <td>
                                                <a href="details.php">
                                                    <img src="{{ asset('public/assets/images/fashion/brand') }}/{{ $brand->image }}" class="blur-up lazyload" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <p class="mt-0">{{ $brand->name }}</p>
                                            </td>
                                            <td>
                                                <p class="fs-6 m-0">{{ $brand->slug }}</p>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.delete', ['id_product' => $product->id]) }}" onclick="return confirm('Apakah anda yakin ingin menghapus?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade table-dashboard dashboard wish-list-section" id="wishlist">
                            <div class="box-head mb-3">
                                <h3>Category</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table cart-table">
                                    <thead>
                                        <tr class="table-head">
                                            <th scope="col">image</th>
                                            <th scope="col">Category Name</th>
                                            <th scope="col">slug</th>
                                            <th scope="col" colspan="2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                        <tr>
                                            <td>
                                                <a href="details.php">
                                                    <img src="{{ asset('assets/images/fashion/category') }}/{{ $category->image }}" class="blur-up lazyload" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <p class="m-0">{{ $category->name }}</p>
                                            </td>
                                            <td>
                                                <p class="fs-6 m-0">{{ $category->slug }}</p>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.delete', ['id_product' => $product->id]) }}" onclick="return confirm('Apakah anda yakin ingin menghapus?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- user dashboard section end -->

@endsection
