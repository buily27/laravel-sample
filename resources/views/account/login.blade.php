@extends('account.layout')
@section('title')
    {{ __('link.login') }}
@endsection
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <span href="{{ route('login') }}" class="h2"><b>{{ __('user.title') }}</b></span>
        </div>
        <div class="card-body">
            <form action="{{ route('checkLogin') }}" method="post">
                @csrf
                <div class="input-group mb-4">
                    <input type="text" class="form-control" name="username" placeholder="{{ __('user.username') }}"
                        value="{{ old('username') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row message-error">
                    @error('username')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-group mb-4">
                    <input type="password" class="form-control" name="password" placeholder="{{ __('user.password') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row message-error">
                    @error('password')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="row">

                    <!-- /.col -->
                    <div class="col-3"></div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-block">{{ __('link.login') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
        </div>
        </form>
        <div class="row">
            <div class="col-md-8 " style="margin-left: 20px">
                @if (session()->has('error'))
                    <p class="text-red">
                        {{ session()->get('error') }}
                    </p>
                @endif
            </div>
            <!-- /.social-auth-links -->
        </div>
        <!-- /.card-body -->
    </div>
@endsection
