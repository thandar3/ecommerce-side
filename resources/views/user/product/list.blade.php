@extends('user.layoutUser.master')

@section('title')
    Product list
@endsection

@section('contents')
    <!-- Shop Start -->
    <div class="container-fluid mt-4">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class=" pr-3">Filter
                        by price</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div
                            class="custom-control  bg-dark custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="" class="custom-control-input" checked id="price-all">
                            <label class="ms-2 mt-1 text-white" for="price-all">Categories</label>
                            <span class="badge me-4 border font-weight-normal text-white">{{ count($categories) }}</span>
                        </div>
                        <hr>
                        @foreach ($categories as $c)
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3"
                                style="cursor: pointer">
                                <a href="{{ route('product#filter', $c->name) }}">
                                    <label class="text-danger" for="price-1">{{ $c->name }}</label>
                                </a>

                            </div>
                        @endforeach
                        <a href="{{ route('product#list') }}" class="ms-4">
                            <label class="text-danger" for="price-1">All</label>
                        </a>

                    </form>
                </div>
                <!-- Price End -->


                <div class="">
                    <button class="btn btn btn-outline-danger w-100">Order</button>
                </div>
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="">
                                    <button type="button" class="btn btn-dark text-white  position-relative"
                                        style="border-radius: 10px">
                                        <i class="fa-solid fa-cart-plus"></i>
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

                                        </span>
                                    </button>
                                </a>
                                <a href="" class="ms-4">
                                    <button type="button" class="btn btn-dark text-white  position-relative"
                                        style="border-radius: 10px">
                                        <i class="fa-solid fa-clock-rotate-left"></i>
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{-- {{ count($history) }} --}}
                                        </span>
                                    </button>
                                </a>
                            </div>
                            {{-- <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sorting" id="sortingOption" class="form-control">
                                        <option value="">Chose One Option</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descing</option>
                                    </select>
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    <span class="row" id="dataList">
                        @if (count($products) != 0)
                            @foreach ($products as $p)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height: 300px"
                                                src="{{ asset('storage/ProductsImages/' . $p->image) }}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('eachProduct#detail', ['id' => $p->id, 'productPrice' => $p->price]) }}"><i
                                                        class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="">{{ $p->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $p->price }} Kyats</h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center fs-2 text-dark col-6 offset-3">There is no Product list</p>
                        @endif
                    </span>

                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection
