@extends('admin.layoutAdmin.master')

@section('title', 'Account Detail')

@section('contents')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('category#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>

                </div>
                <div class="row">
                    <div class="col-3 offset-7 mb-2">
                        @if (session('update success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>
                                    <i class="zmdi zmdi-check"></i> {{ session('update success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Edit Account </h3>
                            </div>
                            <hr>


                            <form action="{{ route('account#update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-3 offset-2">
                                        @if (Auth::user()->image == null)
                                            <img src="{{ asset('defaultImage.png') }}" alt="Default user" />
                                        @else
                                            <img class=""
                                                src="{{ asset('storage/userPhotos/' . Auth::user()->image) }}"
                                                alt="Card image cap">
                                        @endif

                                        <div class="mt-3">
                                            <input type="file" name="image"
                                                class="form-control  @error('image')is-invalid @enderror">
                                            @error('image')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6 offset-1 mt-3 text-muted">

                                        <div class="mt-3">
                                            <input type="text" name="user_name" value="{{ $user->name }}"
                                                class="form-control  @error('user_name')is-invalid @enderror">
                                            @error('user_name')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <input type="email" name="user_email"
                                                class="form-control  @error('user_email')is-invalid @enderror"
                                                value="{{ $user->email }}">
                                            @error('user_email')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <input type="number" name="user_phone" value="{{ $user->phone }}"
                                                class="form-control  @error('user_phone')is-invalid @enderror">
                                            @error('user_phone')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <input type="text" name="user_address" value="{{ $user->address }}"
                                                class="form-control  @error('user_address')is-invalid @enderror">
                                            @error('user_address')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <input type="text" name="role" value="{{ $user->role }}"
                                                class="form-control  @error('user_address')is-invalid @enderror" disabled>

                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-3 offset-2">
                                        <button class="btn btn-dark text-white" type="submit">
                                            <i class="fa-solid fa-user-pen"></i>
                                            Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
