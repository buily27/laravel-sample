<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        @can('viewAny', \App\User::class)
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('user.index')}}" class="nav-link">{{__('link.homepage')}}</a>
        </li>
        @endcan
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{route('logout')}}" role="button">
                {{__('link.logout')}}
            </a>
        </li>
    </ul>
</nav>