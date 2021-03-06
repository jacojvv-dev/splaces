@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="section">
            <div class="box">
                <h3 class="title is-3">Login</h3>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{--email field--}}
                    <div class="field">
                        <label for="email" class="label">E-Mail Address</label>
                        <div class="control">
                            <input id="email" type="email"
                                   placeholder="sarahjones@gmail.com"
                                   class="input {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    {{--password field--}}
                    <div class="field">
                        <label for="password" class="label">Password</label>
                        <div class="control">
                            <input id="password" type="password"
                                   class="input {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   placeholder="Password"
                                   name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    {{--remember field--}}
                    <div class="field">
                        <label class="checkbox">
                            <input type="checkbox"
                                   name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>

                    {{--submit form--}}
                    <div class="control">
                        <button class="button is-primary" type="submit">Login</button>
                    </div>
                </form>
            </div>
            <div style="text-align: center;">
                <a href="{{ route('password.request') }}">
                    Forgot Your Password?
                </a>
            </div>

        </div>
    </div>














@endsection
