@extends('layout')
@section('title')
    {{ __('user.edit') }}
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ __('user.edit') }}</h3>
        </div>
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('user.update', $dataUser->id) }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <input type="hidden" name="id" value="{{ $dataUser->id }}">
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">{{ __('user.name') }} <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                        placeholder="{{ __('form.input_name') }}" value="{{ old('name', $dataUser->name) }}">
                    @error('name')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">{{ __('user.phone') }}</label>
                    <input type="text" name="phone" class="form-control" id="exampleInputPassword1"
                        placeholder="{{ __('form.input_phone') }}" value="{{ old('phone', $dataUser->phone) }}">
                    @error('phone')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">{{ __('user.username') }} <span
                            class="text-danger">*</span></label>
                    <input type="text" name="username" class="form-control" id="exampleInputPassword1"
                        placeholder="{{ __('form.input_username') }}"
                        value="{{ old('username', $dataUser->username) }}">
                    @error('username')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>{{ __('user.image') }}</label>
                    <input type="file" name='image' class="form-control-file" id="exampleInputFile">
                    <input type="hidden" name='old_image' value="{{ $dataUser->image }}">
                </div>
                @error('image')
                    <p class="text-red">{{ $message }}</p>
                @enderror

                <div class="col-sm-3">
                    @if (!empty($dataUser->image))
                        <div class="row">
                            <label>{{ __('form.old_image') }}</label>
                        </div>
                        <img class="img-fluid mb-3" src="{{ asset('storage/' . $dataUser->image) }}">
                    @endif
                    <div class="row">
                        <label id='new_image'></label>
                    </div>
                    <img class="img-fluid mb-3" src="" id="preview-image">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{ __('user.dob') }} <span class="text-danger">*</span></label>
                    <input type="date" name="dob" class="form-control" id="exampleInputPassword1"
                        placeholder="{{ __('form.input_dob') }}" value="{{ old('dob', $dataUser->dob) }}">
                    @error('dob')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">{{ __('user.address') }} <span
                            class="text-danger">*</span></label>
                    <input type="text" name="address" class="form-control" id="exampleInputPassword1"
                        placeholder="{{ __('form.input_address') }}" value="{{ old('address', $dataUser->address) }}">
                    @error('address')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">{{ __('user.worked_at') }} <span
                            class="text-danger">*</span></label>
                    <input type="date" name="worked_at" class="form-control" id="exampleInputPassword1"
                        placeholder="{{ __('form.input_worked_at') }}"
                        value="{{ old('worked_at', $dataUser->worked_at) }}">
                    @error('worked_at')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>{{ __('user.role') }} <span class="text-danger">*</span></label>
                            <select class="form-control" name="role_id">
                                <option>{{ __('form.select_role') }}</option>
                                @foreach ($allRoles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ old('role_id', $dataUser->role_id) == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
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
                                <option>{{ __('form.select_department') }}</option>
                                @foreach ($allDepartments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ old('department_id', $dataUser->department_id) == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <p class="text-red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>{{ __('form.select_work_status') }} <span class="text-danger">*</span></label>
                            <select class="form-control" name="work_status">
                                <option value="{{ config('common.IS_WORK') }}"
                                    {{ old('work_status', $dataUser->work_status) == config('common.IS_WORK') ? 'selected' : '' }}>
                                    {{ __('form.working') }}</option>
                                <option value="{{ config('common.QUIT') }}"
                                    {{ old('work_status', $dataUser->work_status) == config('common.QUIT') ? 'selected' : '' }}>
                                    {{ __('form.quit') }}</option>
                            </select>
                            @error('department_id')
                                <p class="text-red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                @can('updateRole', $dataUser)
                    <div class="form-check">
                        <input type="checkbox" name="is_admin[]" class="form-check-input" @if ($dataUser->is_admin == config('common.IS_ADMIN'))
                        checked
                        @endif>
                        <label class="form-check-label" for="exampleCheck1">{{ __('user.setAdmin') }}</label>
                    </div>
                @endcan
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('form.edit') }}</button>
                <a href="{{ route('user.index') }}" class="btn btn-secondary">{{ __('link.cancel') }}</a>
            </div>
        </form>
    </div>
@endsection
<!-- /.card -->

@section('previewImage')
    <script src="js/previewImage.js"></script>
@endsection
