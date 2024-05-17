@extends('admin.layoutAdmin.master')

@section('title', 'Account Detail')

@section('contents')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('category#list') }}"><button class="btn bg-dark text-white my-3">back</button></a>
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
                                <h3 class="text-center title-2">Account Info</h3>
                            </div>
                            <hr>

                            @if (session('updateSuccess'))
                                <div class="alert alert-success alert-dismissible fade show " role="alert">
                                    <strong>
                                        <i class="zmdi zmdi-check"></i>
                                        {{ session('updateSuccess') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-3 offset-2">
                                    @if (Auth::user()->image == null)
                                        <img src="{{ asset('defaultImage.png') }}" alt="Default user" />
                                    @else
                                        <img src="{{ asset('storage/userPhotos/' . Auth::user()->image) }}" alt=""
                                            class="mb-3">
                                    @endif
                                </div>

                                <div class="col-6 offset-1 mt-3 text-muted">
                                    <h4><i class="fa-regular fa-user me-2"></i> {{ Auth::user()->name }}</h4>
                                    <h4 class="mt-3"><i class="fa-solid fa-envelope-circle-check me-2"></i>
                                        {{ Auth::user()->email }}
                                    </h4>
                                    <h4 class="mt-3"><i class="fa-solid fa-phone me-2"></i> {{ Auth::user()->phone }}</h4>
                                    <h4 class="mt-2"><i class="fa-solid fa-location-dot me-2"></i>
                                        {{ Auth::user()->address }}</h4>
                                    <h4 class="mt-3"><i class="fa-solid fa-clock me-2"></i>
                                        {{ Auth::user()->created_at->format('j-F-Y') }}
                                    </h4>

                                </div>
                            </div>

                            {{-- <div class="row">
                                <div class="col-3 offset-2">
                                    <a href="{{ route('account#edit', Auth::user()->id) }}">
                                        <button class="btn btn-dark text-white"><i class="fa-solid fa-user-pen"></i> Edit
                                            Profile</button>
                                    </a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
