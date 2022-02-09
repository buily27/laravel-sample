@extends('layout')
@section('title')
    {{ __('user.title') }}
@endsection
@section('content')
    <div class="card" style="margin-top: 20px;">
        <div class="d-flex justify-content-between table-title">
            <h2 class="card-title"><b>{{ __('user.title') }}</b></h2>
            <button class="btn btn-success btn-export">
                Export
            </button>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif

        <div class="col-md-12" style="margin: 20px 0">
            <form method="GET" id="search-filter">
                <div class="row">
                    @can('viewAdmin', \App\User::class)
                        <div class="col-md-2">
                            <select name='department_id' class="form-control">
                                <option selected disabled>{{ __('sort.department') }}</option>
                                @foreach ($allDepartments as $department)
                                    <option value="{{ $department->id }}" @if (request()->department_id == $department->id)selected @endif>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endcan
                    <div class="col-md-2">
                        <select name="work_status" class="form-control">
                            <option selected disabled>{{ __('sort.work_status') }}</option>
                            <option value="quit" @if (request()->work_status == 'quit')selected @endif>
                                {{ __('sort.quit') }}
                            </option>
                            <option value="working" @if (request()->work_status == 'working')selected @endif>
                                {{ __('sort.working') }}</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="sort_by" class="form-control">
                            <option selected disabled>{{ __('sort.choose') }}</option>
                            <option value="dob" @if (request()->sort_by == 'dob')selected @endif>{{ __('sort.dob') }}</option>
                            <option value="worked_at" @if (request()->sort_by == 'worked_at')selected @endif>{{ __('sort.date') }}
                            </option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="sort_type" class="form-control">
                            <option selected disabled>{{ __('sort.choose') }}</option>
                            <option value="asc" @if (request()->sort_type == 'asc')selected @endif>{{ __('sort.ascending') }}</option>
                            <option value="desc" @if (request()->sort_type == 'desc')selected @endif>{{ __('sort.descending') }}</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary" id="filter-submit">
                            <i class="fas fa-filter"></i>
                        </button>
                    </div>
                    @if (Auth::user()->is_admin != config('common.IS_ADMIN'))
                        <div class="col-md-2">
                        </div>
                    @endif
                    <div class="input-group col-md-2">
                        <div class="form-outline">
                            <input type="search" id="keyword" name="keyword" class="form-control"
                                value="{{ request()->keyword }}" />
                        </div>
                        <button class="btn btn-primary" id="search-submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>

            </form>
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
                <thead>
                    <tr>
                        <th>{{ __('user.image') }}</th>
                        <th>{{ __('user.name') }}</th>
                        <th>{{ __('user.username') }}</th>
                        <th>{{ __('user.phone') }}</th>
                        <th>{{ __('user.dob') }}</th>
                        <th>{{ __('user.address') }}</th>
                        <th>{{ __('user.role') }}</th>
                        <th>{{ __('user.department') }}</th>
                        <th>{{ __('user.updated_at') }}</th>
                        <th>{{ __('user.worked_at') }}</th>
                        <th>{{ __('user.work_status') }}</th>
                        @can('viewAdmin', \App\User::class)
                            <th></th>
                        @endcan
                    </tr>
                </thead>
                <tbody>

                    @if (count($allUsers))
                        @foreach ($allUsers as $user)
                            <tr>
                                <td>
                                    @if (!empty($user->image))
                                        <img src="{{ 'storage/' . $user->image }}"
                                            class="profile-user-img img-responsive" style="border: 0">
                                    @else
                                        <img src="{{ 'uploads/default_image.png' }}"
                                            class="profile-user-img img-responsive" style="border: 0">
                                    @endif

                                </td>

                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    {{ $user->username }}
                                </td>
                                <td>
                                    {{ $user->phone }}
                                </td>
                                <td>
                                    {{ $user->dob }}
                                </td>
                                <td>
                                    {{ $user->address }}
                                </td>
                                <td>
                                    {{ $user->role->name }}
                                </td>
                                <td>
                                    {{ $user->department->name }}
                                </td>
                                <td>
                                    {{ $user->updated_at }}
                                </td>
                                <td>
                                    {{ $user->worked_at }}
                                </td>
                                <td>
                                    @if ($user->work_status == config('common.IS_WORK'))
                                        {{ __('user.is_work') }}
                                    @else
                                        {{ __('user.quit') }}
                                    @endif
                                </td>
                                @can('viewAdmin', \App\User::class)
                                    <td>
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-outline-primary"><i
                                                class="fas fa-pencil-alt"></i></a>

                                        <a href="#" class="btn btn-outline-danger" data-toggle="modal"
                                            data-target="#modal-delete-{{ $user->id }}"
                                            data-link="{{ route('user.destroy', $user->id) }}"><i
                                                class="fas fa-trash"></i></a>

                                        <form id="delete_form_{{ $user->id }}"
                                            action="{{ route('user.destroy', $user->id) }}" method="POST"
                                            style="display: none;">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                        <a href="#" class="btn btn-outline-danger" data-toggle="modal"
                                            data-target="#modal-reset-{{ $user->id }}"><i class="fas fa-recycle"></i></a>
                                    </td>

                                    @include('modals/delete')
                                    @include('modals/resetPassword')
                                @endcan
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center" colspan="12">{{ __('messages.empty') }}</td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
        <div class="pagination justify-content-center m-0">
            {{ $allUsers->appends(request()->all())->links() }}
        </div>

    @endsection

    @section('user/js')
        <script src="js/export.js"></script>
    @endsection
