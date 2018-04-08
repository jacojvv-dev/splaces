@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="section">
            <div class="box">
                <h3 class="title is-3">Register</h3>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    {{--name field--}}
                    <div class="field">
                        <label class="label">Name</label>
                        <div class="control">
                            <input id="name" type="text"
                                   class="input {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   placeholder="Sarah Jones"
                                   name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    {{--email field--}}
                    <div class="field">
                        <label for="email" class="label">E-Mail Address</label>
                        <div class="control">
                            <input id="email" type="email"
                                   class="input {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   placeholder="sarahjones@gmail.com"
                                   name="email" value="{{ old('email') }}" required>

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

                    {{--confirm password field--}}
                    <div class="field">
                        <label for="password-confirm" class="label">Confirm Password</label>
                        <div class="control">
                            <input id="password-confirm" type="password" class="input"
                                   placeholder="Confirm Password"
                                   name="password_confirmation" required>
                        </div>
                    </div>

                    {{--submit form--}}
                    <div class="control">
                        <button class="button is-primary" type="submit">Register Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
