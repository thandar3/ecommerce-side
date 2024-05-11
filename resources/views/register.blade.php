@extends('layout.master')

@section('title')
    Register Page
@endsection

@section('content')
    <div class="login-form">
        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="form-group">
                <label>Username</label>
                <input class="au-input au-input--full" type="text" name="name" placeholder="Username">
            </div>
            @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
            </div>
            @error('email')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label>Phone Num</label>
                <input class="au-input au-input--full" type="number" name="phone" placeholder="09******">
            </div>
            @error('phone')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label>Address</label>
                <input class="au-input au-input--full" type="text" name="address" placeholder="address">
            </div>
            @error('address')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <select name="role" id="" class="form-control">
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
            @error('role')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
            </div>
            @error('password')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password_confirmation"
                    placeholder="Confirm Password">
            </div>
            @error('password_confirmation')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

        </form>
        <div class="register-link">
            <p>
                Already have account?
                <a href="{{ route('auth#loginPage') }}">Sign In</a>
            </p>
        </div>
    </div>
@endsection
