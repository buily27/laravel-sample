<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    @if (Auth::user()->role_id == config('common.IS_MANAGEMENT') && Auth::user()->is_admin != config('common.IS_ADMIN'))
        <a href="{{ route('user.index') }}" class="brand-link" style="text-align: center;">
            <span class="logo-lg"><b>{{ Auth::user()->department->name }}</b></span>
        </a>
    @endif
    @if (Auth::user()->is_admin == config('common.IS_ADMIN'))
        <a href="{{ route('user.index') }}" class="brand-link" style="text-align: center;">
            <span class="logo-lg"><b>Admin</b></span>
        </a>
    @endif



    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        @can('viewAny', \App\User::class)
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    @if (!empty(Auth::user()->image))
                        <img src="{{ 'storage/' . Auth::user()->image }}" class="user-image-circle" alt="User Image">
                    @else
                        <img src="{{ 'uploads/default_image.png' }}" class="user-image-circle" alt="User Image">
                    @endif
                </div>
                <div class="info">
                    <a href="{{ route('profile') }}" class="d-block">{{ Auth::user()->name }}</a>
                </div>
            </div>
            <!-- Sidebar Menu -->
        @endcan

        @can('viewAdmin', \App\User::class)
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item @if (str_contains(request()->path(), 'department')) menu-is-opening menu-open @endif">
                        <a href="{{ route('department') }}" class="nav-link" @if (str_contains(request()->path(), 'department'))
                            id="active_url"
                            @endif>
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                {{ __('department.title') }}
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('department') }}" class="nav-link @if (Request::is('department'))active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('department.list') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('department/create') }}" class="nav-link @if (Request::is('department/create'))active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('department.add') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>    

                    <li class="nav-item @if (str_contains(request()->path(), 'user')) menu-is-opening menu-open @endif">
                        <a href="{{ route('user.index') }}" class="nav-link" @if (str_contains(request()->path(), 'user'))
                            id="active_url"
                            @endif>
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                {{ __('user.title') }}
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}" class="nav-link @if (Request::is('user'))active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('user.list') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.create') }}" class="nav-link @if (Request::is('user/create'))active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('user.add') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        @endcan

        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
