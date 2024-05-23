@extends('user.layoutUser.master');

@section('title')
    Product detail
@endsection

@section('contents')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('storage/ProductsImages/' . $product->image) }}"
                                alt="Image">
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $product->name }}</h3>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <small class="pt-1"><i class="fa-solid fa-eye"></i> {{ $product->view_count + 1 }}</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{ $product->price }} Kyats</h3>
                    <input type="hidden" value="{{ Auth::user()->id }}" id="userId">
                    <input type="hidden" value="{{ $product->id }}" id="productId">
                    <p class="mb-4">{{ $product->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-danger btn-minus">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center" value="1"
                                id="orderCount">
                            <input type="hidden" class="form-control bg-secondary border-0 text-center"
                                value="{{ Auth::user()->id }}" id="userId">

                            <div class="input-group-btn">
                                <button class="btn btn-danger btn-plus">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <a href="{{ route('ajax#orderList') }}">
                            <button type="button" id="addCartBtn" class="btn btn-outline-danger px-3"><i
                                    class="fa fa-shopping-cart mr-1"></i> Add To
                                Cart</button>
                        </a>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You
                May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($products as $p)
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="height: 300px"
                                    src="{{ asset('storage/ProductsImages/' . $p->image) }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $p->price }} kyats</h5>
                                    <input type="hidden" id="productPrice" value="{{ $productPrice }}">
                                    <input type="hidden" value="{{ $p->id }}" id="productId">
                                    {{-- <h6 class="text-muted ml-2"><del>$123.00</del></h6> --}}
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('#addCartBtn').click(function() {
                $.ajax({
                    type: 'GET',
                    url: 'http://localhost:8000/ajax/totalProduct',
                    data: {
                        'userId': $('#userId').val(),
                        'productId': $('#productId').val(),
                        'count': $('#orderCount').val(),
                        'price': $('#productPrice').val(),
                    },
                    dataType: 'json',

                });
            })
        })
    </script>
@endsection
{{-- <script>
    $(document).ready(function() {

        $.ajax({
            type: 'get',
            url: '/user/ajax/increase/viewCount',
            data: {
                'productId': $('#pizzaId').val(),
            },
            dataType: 'json',
        });


        //click to increate card
        $('#addCartBtn').click(function() {

            $.ajax({
                type: 'get',
                url: '/user/ajax/addToCart',
                data: {
                    'userId': $('#userId').val(),
                    'pizzaId': $('#pizzaId').val(),
                    'count': $('#orderCount').val(),
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response.status)
                }
            })
        })
    })
</script> --}}

</html>
