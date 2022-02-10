<table>
    <thead>
        <tr>
            <th>{{ __('user.name') }}</th>
            <th>{{ __('user.username') }}</th>
            <th>{{ __('user.phone') }}</th>
            <th>{{ __('user.dob') }}</th>
            <th>{{ __('user.address') }}</th>
            <th>{{ __('user.role') }}</th>
            <th>{{ __('user.department') }}</th>
            <th>{{ __('user.created_at') }}</th>
            <th>{{ __('user.updated_at') }}</th>
            <th>{{ __('user.worked_at') }}</th>
            <th>{{ __('user.work_status') }}</th>
        </tr>
    </thead>
    <tbody>
        @if (count($users))
            @foreach ($users as $user)
                <tr>
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
                        {{ $user->created_at }}
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
                </tr>
            @endforeach
        @else
            <tr>
                <td>{{ __('messages.empty') }}</td>
            </tr>
        @endif

    </tbody>
</table>
