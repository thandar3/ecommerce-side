@extends('user.layoutUser.master')

@section('title')
    Order Vocher
@endsection

<style>
    .b {
        border: 1px solid black;
        padding: 10px;
        border-radius: 10px;
    }

    .items {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
</style>

@section('contents')
    <div class="row">
        <div class="col-sm-12 col-lg-2 offset-2">
            <div class="b">
                @if (Auth::user()->image == null)
                    <img src="{{ asset('defaultImage.png') }}" width="50px" height="50px" style="border-radius: 50px">
                @else
                    <img src="{{ asset('storage/userPhotos/' . Auth::user()->image) }}" width="50px" height="50px"
                        style="border-radius: 50px" alt="">
                @endif
                <div class=" border-sm ">
                    <h5 for="">User Name <span class="float-end">{{ Auth::user()->name }}</span></h5>

                </div>

                <div class="items border-sm mt-2">
                    <h5 for="">Order item </h5>
                    @foreach ($order as $o)
                        <ul>
                            <li>{{ $o->ProductName }}</li>
                        </ul>
                    @endforeach
                </div>

            </div>
        </div>

        <div class="col-sm-12 col-lg-4 offset-1">
            <form action="{{ route('ajax#deliveryUser') }}" method="POST">
                @csrf
                <div class="container">
                    @if (session('createSuccess'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>
                                <i class="zmdi zmdi-check"></i> {{ session('createSuccess') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h3 class="fs-3">Info for Delivery</h3>
                    <div class="form-group mt-3">
                        <label>
                            <h5 class="me-2">Your Name</h5>
                        </label>
                        <input class="au-input au-input--full b-none p-3" style="border-radius: 15px" type="text"
                            name="name" placeholder="Name">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label>
                            <h5 class="me-2">Email</h5>
                        </label>
                        <input class="au-input au-input--full b-none p-3 ms-5" style="border-radius: 15px" type="email"
                            name="email" placeholder="Email">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mt-3 ">
                        <label>
                            <h5 class="me-2">Phone No</h5>
                        </label>
                        <input class="au-input au-input--full b-none p-3 ms-2" style="border-radius: 15px" type="number"
                            name="phone" placeholder="09******">
                        @error('phone')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label>
                            <h5 class="me-3">Address</h5>
                        </label>
                        <input class="au-input au-input--full b-none p-3 ms-3" style="border-radius: 15px" type="text"
                            name="address" placeholder="Address">
                        @error('address')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label>
                            <h5 class="me-3">Delivery fee</h5>
                        </label>
                        <input style="border-radius: 10px; text-align:center;" name="delivery_fee" placeholder="3000"
                            type="text" disabled>
                        <input style="border-radius: 10px; text-align:center;" name="delivery_fee" type="hidden"
                            value="3000">

                    </div>

                </div>

                <button class="btn btn-danger
                    " type="submit"
                    style="border-radius: 10px; margin-left: 280px; padding:5px: width:70px">send</button>

            </form>
        </div>
    </div>
@endsection
