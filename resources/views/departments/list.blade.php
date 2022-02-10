@extends('layout')
@section('title')
    {{ __('department.title') }}
@endsection
@section('content')
    <div class="card">
        <div class="card-header border-0">
            <h2 class="card-title"><b>{{ __('department.title') }}</b></h2>
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
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
                <thead>
                    <tr>
                        <th>{{ __('department.name') }}</th>
                        <th>{{ __('department.manager') }}</th>
                        <th>{{ __('department.description') }}</th>
                        <th>{{ __('department.created_at') }}</th>
                        <th>{{ __('department.updated_at') }}</th>
                    </tr>
                </thead>
                <tbody>

                    @if (count($allDepartment))
                        @foreach ($allDepartment as $department)
                            <tr>
                                <td>
                                    {{ $department->name }}
                                </td>
                                <td>
                                    @foreach ($department->users as $user)
                                        @if ($user->role_id == config('common.IS_MANAGEMENT'))
                                            {{ $user->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    {{ $department->description }}
                                </td>
                                <td>
                                    {{ $department->created_at }}
                                </td>
                                <td>
                                    {{ $department->updated_at }}
                                </td>
                                <td> <a href="{{ route('department/edit', $department->id) }}"
                                        class="btn btn-outline-primary"><i class="fas fa-pencil-alt"></i>
                                    </a>

                                    <a href="#" class="btn btn-outline-danger" data-toggle="modal"
                                        data-target="#modal{{ $department->id }}"><i class="fas fa-trash"></i>
                                    </a>

                                    <form id="delete_form_{{ $department->id }}"
                                        action="{{ route('department/delete', $department->id) }}" method="GET"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </td>
                                <div class="modal fade" id="modal{{ $department->id }}" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">{{ __('form.delete_confirm') }}</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            @if (!count($department->users))
                                                <div class="modal-body">{{ __('link.message_delete') }}</div>
                                            @else
                                                <div class="modal-body">{{ __('link.message_exists_user') }}</div>
                                            @endif

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    {{ __('form.cancel') }}
                                                </button>
                                                @if (!count($department->users))
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="event.preventDefault();document.getElementById('delete_form_{{ $department->id }}').submit()">{{ __('link.delete') }}
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
            {{ $allDepartment->links() }}
        </div>
    </div>

@endsection
