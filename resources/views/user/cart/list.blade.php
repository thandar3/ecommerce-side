@extends('user.layoutUser.master')

@section('title')
    Order cart
@endsection

<style>
    .user {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .cart {
        border: 2px solid red;
        border-radius: 10px;
    }

    .middle {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

@section('contents')
    <div class="row">
        <div class="col-sm-12 col-lg-2 offset-2" class="user">
            @if (Auth::user()->image == null)
                <img class="img-thumbnail" width="200px" height="200px" style="border-radius: 20px"
                    src="{{ asset('defaultImage.png') }}" alt="user Profile">
            @else
                <img class="img-thumbnail" width="200px" height="200px" style="border-radius: 20px"
                    src="{{ asset('storage/userPhotos/' . Auth::user()->image) }}" alt="">
            @endif

            <br>
            <label for="">User Name</label>
            <h5>{{ Auth::user()->name }}</h5>
            <br>
            <a href="{{ route('ajax#vocher') }}">
                <button class="btn btn-outline-danger" style="border-radius: 20px">go to get the Voucher</button>
            </a>
        </div>
        <div class="col md-6 col-lg-4 offset-1 col-sm-12">

            @if (count($order))
                <div class='cart'>
                    <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                        <thead class="thead-primary">
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>qty</th>
                                <th>Total Price</th>
                                <th>Order Code</th>
                                <th>del</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($order as $o)
                                <tr>
                                    <td>{{ $o->ProductName }}</td>
                                    <td>
                                        <img class="img-fluid w-50 h-50" style="height: 300px"
                                            src="{{ asset('storage/ProductsImages/' . $o->ProductImage) }}" alt="">
                                    </td>
                                    <td>{{ $o->totalProduct }}</td>
                                    <td>{{ $o->total_each }}</td>
                                    <td>{{ $o->pin_code }}</td>
                                    <td class="delOrder"><button class="btn btn-sm btn-danger btnRemove"><i
                                                class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            @else
                <div class="middle">
                    <h4 class="text-danger">There is no orders</h4>
                </div>
            @endif


        </div>
    </div>
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('.delOrder').click(function() {
                $parentNode = $(this).parents('.align-middle tr');
                $parentNode.remove();
            })

            w
        })
    </script>
@endsection
