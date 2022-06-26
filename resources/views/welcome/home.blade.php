@extends('welcome.app')

@section('content')
    <div class="container">
        <div class="content">
            <div class="title">
                <h1>WELCOME TO THE</h1>
                <H1>CV. SUMBER KARUNIA WEBSITE</H1>
            </div>

            <div class="btn-container">

                <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>

                <a href="{{ route('user.login.view') }}" class="btn-login">Login</a>
                <a href="{{ route('user.register.view') }}" class="btn-register">Register</a>

            </div>

        </div>
    </div>
@endsection
