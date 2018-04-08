@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="section">
            <div class="box">
                <h3 class="title is-3">Reset Password</h3>
                @if (session('status'))
                    <div class="notification is-success">
                        {{ session('status') }}
                    </div>
                @endif


                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="field">
                        <label for="email" class="label">E-Mail Address</label>

                        <div class="control">
                            <input id="email" type="email"
                                   class="input {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   placeholder="E-Mail Address"
                                   name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="control">
                        <button type="submit" class="button is-primary">
                            Send Password Reset Link
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>





@endsection
