@extends('user.layoutUser.master')

@section('title')
    Vocher Detail
@endsection

<style>
    .middle_page {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border: 1px solid black;
    }

    .Title {
        text-align: center;
    }
</style>

@section('contents')
    <div class="row">
        <div class="col col-lg-2 offset-5 border-md border p-2" style="border: 1px solid black;border-radius:10px;">
            <div class="container">
                <label for="" class="ms-2">Product Items</label>
                @foreach ($orderLists as $o)
                    <div>
                        <ul>
                            <li>{{ $o->ProductName }}</li>
                        </ul>
                    </div>
                @endforeach
                <div>
                    <label for="">Order Code</label>
                    <h5>{{ $o->pin_code }}</h5>
                </div>
                <div>
                    <label for="">Total Price With Delivery Fee</label>
                    <h5>{{ $o->total_price }}</h5>
                </div>
                <div>
                    <label for="">Created Date</label>
                    <h5>{{ $o->created_at }}</h5>
                </div>
                <div class="">
                    <label for="">Delivery Fee</label>
                    <input type="text" style="border: none;text-align:center;" name="delivery_fee" placeholder="3000">
                    <br>
                    <a href="{{ route('product#list') }}" class="mt-3">
                        <button class="btn btn-danger mt-3 float-end
                    " type="button"
                            style="border-radius: 10px;">Back to home</button>
                    </a>
                </div>


            </div>
        </div>
    </div>
@endsection
