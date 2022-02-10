@extends('layout')
@section('title')
    {{ __('department.add') }}
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ __('department.add') }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('department/store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">{{ __('department.name') }} <span
                            class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                        placeholder="{{ __('form.input_name') }}" value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{ __('department.description') }}</label>
                    <input type="text" name="description" class="form-control" id="exampleInputPassword1"
                        placeholder="{{ __('form.input_description') }}" value="{{ old('description') }}">
                    @error('description')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('form.add') }}</button>
                <a href="{{ route('department') }}" class="btn btn-secondary">{{ __('link.cancel') }}</a>
            </div>
        </form>
    </div>
@endsection
<!-- /.card -->
