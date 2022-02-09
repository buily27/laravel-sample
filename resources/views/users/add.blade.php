@extends('layout')
@section('title')
    {{ __('user.add') }}
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ __('user.add') }}</h3>
        </div>
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">{{ __('user.name') }} <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                        placeholder="{{ __('form.input_name') }}" value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">{{ __('user.phone') }}</label>
                    <input type="text" name="phone" class="form-control" id="exampleInputPassword1"
                        placeholder="{{ __('form.input_phone') }}" value="{{ old('phone') }}">
                    @error('phone')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{ __('user.username') }} <span
                            class="text-danger">*</span></label>
                    <input type="text" name="username" class="form-control" id="exampleInputPassword1"
                        placeholder="{{ __('form.input_username') }}" value="{{ old('username') }}">
                    @error('username')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('user.image') }}</label>
                    <input type="file" class="form-control-file" id="exampleInputFile" name="image">
                    @error('image')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-sm-3">
                    <label id='new_image'></label>
                    <img class="img-fluid mb-3" src="" id="preview-image">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">{{ __('user.dob') }} <span class="text-danger">*</span></label>
                    <input type="text" name="dob" class="form-control" id="exampleInputPassword1"
                        placeholder="{{ __('form.input_dob') }}" value="{{ old('dob') }}">
                    @error('dob')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{ __('user.address') }} <span
                            class="text-danger">*</span></label>
                    <input type="text" name="address" class="form-control" id="exampleInputPassword1"
                        placeholder="{{ __('form.input_address') }}" value="{{ old('address') }}">
                    @error('address')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{ __('user.worked_at') }} <span
                            class="text-danger">*</span></label>
                    <input type="text" name="worked_at" class="form-control" id="exampleInputPassword1"
                        placeholder="{{ __('form.input_worked_at') }}" value="{{ old('worked_at') }}">
                    @error('worked_at')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">
                            <label>{{ __('user.role') }} <span class="text-danger">*</span></label>
                            <select class="form-control" name="role_id">
                                <option value="">{{ __('form.select_role') }}</option>
                                @foreach ($allRoles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <p class="text-red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>{{ __('user.department') }} <span class="text-danger">*</span></label>
                            <select class="form-control" name="department_id">
                                <option value="">{{ __('form.select_department') }}</option>
                                @if (count($allDepartments))
                                    @foreach ($allDepartments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                @else
                                    {{ __('messages.empty') }}
                                @endif
                            </select>
                            @error('department_id')
                                <p class="text-red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="is_admin[]" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">{{ __('user.setAdmin') }}</label>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('form.add') }}</button>
                <a href="{{ route('user.index') }}" class="btn btn-secondary">{{ __('link.cancel') }}</a>
            </div>
        </form>
    </div>

@endsection

@section('previewImage')
    <script src="js/previewImage.js"></script>
@endsection
<!-- /.card -->
