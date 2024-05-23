@extends('layout.master')

@section('title')
    Login Page
@endsection

<style>
    @import url('https://fonts.googleapis.com/css2?family=Mali:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap');

    .main_title {
        display: flex;
        justify-content: center;
        align-items: center;
        color: rgb(241, 109, 72);
        font-family: "Mali", cursive;
    }

    .change_password {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
</style>

@section('content')
    <div class="login-form">
        <h2 class="main_title">Login With</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
            </div>
            <div class="login-checkbox">
                <label>
                    <input type="checkbox" name="remember">Remember Me
                </label>
            </div>
            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in <span><i
                        class="fa-solid fa-right-to-bracket"></i></span></button>
            <div class="social-login-content">
                <div class="social-button">
                    <button class="au-btn au-btn--block au-btn--blue m-b-20">sign in with facebook <span><i
                                class="fa-brands fa-facebook"></i></span></button>
                    <button class="au-btn au-btn--block au-btn--blue2">sign in with Google <span><i
                                class="fa-brands fa-google"></i></span></button>
                </div>
            </div>
        </form>
        {{-- <div class="change_password">
            <label for="">If you forget password</label>
            <a href="" class="btn btn-outline-red ">
                <button class="text-danger">Change Password</button>
            </a>
        </div> --}}
        <div class="register-link">
            <p>
                Don't you have account?
                <a href="{{ route('auth#registerPage') }}">Sign Up Here</a>
            </p>
        </div>
    </div>
@endsection
