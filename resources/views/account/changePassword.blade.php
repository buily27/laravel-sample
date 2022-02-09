@extends('account.layout')
@section('title')
    {{ __('user.change_password') }}
@endsection
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <span href="{{ route('login') }}" class="h2"><b>{{ __('user.change_password') }}</b></span>
        </div>
        <div class="card-body">
            <form action="{{ route('user.change-password') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="old_password"
                        placeholder="{{ __('user.old_password') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row message-error">
                    @error('old_password')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password"
                        placeholder="{{ __('user.new_password') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row message-error">
                    @error('password')
                        <p class="text-red ">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password_confirmation"
                        placeholder="{{ __('user.confirm_password') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row message-error">
                    @error('password_confirmation')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="row">

                    <!-- /.col -->
                    <div class="col-3"></div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-block">{{ __('link.edit') }}</button>
                        @if (Auth::user()->is_first_login != config('common.IS_FIRST_LOGIN'))
                            <a href="{{ route('profile') }}"
                                class="btn btn-secondary btn-block">{{ __('link.cancel') }}</a>
                        @endif
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <!-- /.social-auth-links -->
        </div>
        <!-- /.card-body -->
    </div>
@endsection
