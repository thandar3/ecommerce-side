<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{ asset('fontawesome-free-6.4.0-web\fontawesome-free-6.4.0-web\css\all.min.css') }}" rel="stylesheet">

    {{-- bootstrap link  --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- bootstrap js link  --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('user/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('user/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">

            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ route('product#list') }}" class="nav-item nav-link active">Home</a>
                            <button type="button" href="{{ route('ajax#orderList') }}" class="nav-item nav-link"
                                id="myOrder">My
                                Order</button>
                            <a href="{{ route('ajax#orderCart') }}" class="nav-item nav-link">
                                Order list</a>
                            <a href="contact.html" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            {{-- <a href="" class="btn px-0 me-2">
                                <i class="fas fa-heart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle"
                                    style="padding-bottom: 2px;">0</span>
                            </a>
                            <a href="" class="btn px-0 ml-3 me-2">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle"
                                    style="padding-bottom: 2px;">0</span>
                            </a> --}}
                            <div class="dropdown d-inline">
                                <a href="" class="btn px-0 ml-3 text-white me-5  dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-user me-2"></i>{{ Auth::user()->name }}
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('user#show') }}" class="dropdown-item">Account</a></li>
                                    <li><a href="{{ route('user#edit', Auth::user()->id) }}"
                                            class="dropdown-item">Account Edit</a></li>

                                    <li>
                                        <div class="dropdown-item">
                                            <form action="{{ route('logout') }}" class="d-inline" method="POST">
                                                @csrf
                                                <button type="submit" style="border-radius: 15px"
                                                    class="bg-dark text-light"><i
                                                        class="fa-solid fa-right-from-bracket me-1"></i>Logout</button>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </div>




                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>image</th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($orderList as $o)
                            <tr>
                                <input type="hidden" id="userId" value="{{ $o->user_id }}">
                                <input type="hidden" id="productId" value="{{ $o->product_id }}">
                                <input type="hidden" id="orderId" value="{{ $o->id }}">
                                <td><img class="img-thumbnail product_image"
                                        src="{{ asset('storage/ProductsImages/' . $o->productImage) }}"
                                        alt="" style="width: 100px;">
                                </td>
                                <td>{{ $o->productName }}
                                </td>
                                <td class="align-middle" id="price">{{ $o->productPrice }} kyats</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus" min="0"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm bg-secondary border-0 text-center"
                                            value="{{ $o->qty }}" id="qty">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="total">{{ $o->total_price }} kyats</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i
                                            class="fa fa-times"></i></button></td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subtotal">kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">3000 kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="totalSum"> kyats</h5>
                        </div>
                        <a href="{{ route('product#list') }}">
                            <button class="btn btn-block btn-primary font-weight-bold my-3 py-3"
                                id="checkList">Proceed To
                                Checkout</button>
                        </a>
                        <a href="{{ route('ajax#clearOrder') }}">
                            <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="cartDelete">Clear
                                Cart</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
                <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed
                    dolor. Rebum tempor no vero est magna amet no</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-danger mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-danger mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-danger mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our
                                Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop
                                Detail</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Shopping
                                Cart</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact
                                Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">My Account</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our
                                Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop
                                Detail</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact
                                Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
                        <p>Duo stet tempor ipsum sit amet magna ipsum tempor est</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Your Email Address">
                                <div class="input-group-append">
                                    <button class="btn btn-danger">Sign Up</button>
                                </div>
                            </div>
                        </form>
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                        <div class="d-flex">
                            <a class="btn btn-danger btn-square mr-2" href="#"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-danger btn-square mr-2" href="#"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-danger btn-square mr-2" href="#"><i
                                    class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-danger btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-danger" href="#">2024</a>. All Rights Reserved.
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('user/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('user/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('user/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('user/mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('user/js/main.js') }}"></script>

</body>

</html>


<script>
    $(document).ready(function() {

        $('.btn-minus').click(function() {
            $parent = $(this).parents('tr');
            $totalPrice = Number($parent.find('#total').text().replace('kyats', ''));
            $eachPrice = Number($parent.find('#price').text().replace('kyats', ''));
            $qty = Number($parent.find('#qty').val());

            $totalPrice = $eachPrice * $qty;
            $parent.find('#total').html(`${$totalPrice} kyats`);

            totalList();

        });


        $('.btn-plus').click(function() {
            $parent = $(this).parents('tr');
            $totalPrice = Number($parent.find('#total').text().replace('kyats', ''));
            $eachPrice = Number($parent.find('#price').text().replace('kyats', ''));
            $qty = Number($parent.find('#qty').val());

            $totalPrice = $eachPrice * $qty;
            $parent.find('#total').html(`${$totalPrice} kyats`);

            totalList();

        })



        $('.btnRemove').click(function() {
            $parent = $(this).parents('tr');
            $userId = $('#userId').val();
            $productId = $('#productId').val(),
                $orderId = $parent.find('#orderId').val();

            $.ajax({
                type: 'get',
                url: '/ajax/orderDelete',
                data: {
                    'user_id': $userId,
                    'product_id': $productId,
                    'order_id': $orderId,
                },
                dataType: 'json',
            })

            $parent.remove();
            totalList();

        })

        function totalList() {
            $totallist = 0;
            $('.align-middle tr').each(function(index, row) {
                $totallist += Number($(row).find('#total').text().replace('kyats', ''));
            });

            $('#subtotal').html(`${$totallist} kyats`);
            $('#totalSum').html(`${$totallist + 3000} kyats `);
        }

        totalList();

        $('#checkList').click(function() {
            $random = Math.floor(Math.random() * 10004);

            $orderList = [];

            $('.align-middle tr').each(function(index, row) {
                $orderList.push({
                    'user_id': $(row).find('#userId').val(),
                    'product_id': $(row).find('#productId').val(),
                    'order_id': $(row).find('#orderId').val(),
                    'qty': $(row).find('#qty').val(),
                    'totalForOne': $(row).find('#total').text().replace('kyats', ''),
                    'subTotal': $('#subtotal').text().replace("kyats",
                        ""),
                    'totalPrice': $('#totalSum').text().replace(
                        "kyats", ""),
                    'order_code': '000' + $random + '|||'
                })

                // if (location.reload()) {
                //     $('.align-middle tr').remove();
                // }

            });



            $.ajax({
                type: 'get',
                url: '/ajax/orderListed',
                data: Object.assign({}, $orderList),
                dataType: 'json',
            });

        });

        $('#cartDelete').click(function() {
            $('.align-middle tr').remove();
            $('#subtotal').html('0 kyats');
            $('#totalSum').html('3000 kyats');

            $.ajax({
                type: 'get',
                url: '/ajax/clearOrder',
                dataType: 'json',
            })

        })

        // $('.align-middle tr').each(function(index, row) {
        //     $('#myOrder').click(function() {
        //         $(this).preventDefault;
        //         row.remove();
        //     })
        // })


    })
</script>
