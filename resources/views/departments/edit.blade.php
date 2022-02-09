@extends('layout')
@section('title')
    {{ __('department.edit') }}
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ __('link.edit_department') }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('department/update', $dataDepartment->id) }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $dataDepartment->id }}">
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">{{ __('department.name') }} <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                        placeholder="{{ __('form.input_name') }}" value="{{ $dataDepartment->name }}">
                    @error('name')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{ __('department.description') }}</label>
                    <input type="text" name="description" class="form-control" id="exampleInputPassword1"
                        placeholder="{{ __('form.input_description') }}" value="{{ $dataDepartment->description }}">
                    @error('description')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">
                            <label>{{ __('department.manager') }}</label>
                            <select class="form-control" name="user_id">
                                <option selected disabled>{{ __('form.select_manager') }}</option>
                                @if (count($dataDepartment->users))
                                    @foreach ($dataDepartment->users as $user)
                                        <option value="{{ $user->id }}" @if ($user->role_id == config('common.IS_MANAGEMENT'))
                                            selected
                                    @endif>
                                    {{ $user->name }}
                                    </option>
                                @endforeach
                                @endif

                            </select>
                            @error('user_id')
                                <p class="text-red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('link.edit') }}</button>
                <a href="{{ route('department') }}" class="btn btn-secondary">{{ __('link.cancel') }}</a>
            </div>
        </form>
    </div>
@endsection
<!-- /.card -->
