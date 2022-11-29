<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ $activePage == 'dashboard' ? ' active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
        {{ __('Dashboard') }}
        </p>
    </a>
    @can('user-list')
    <li class="nav-item">
        <a href="{{ route('users.index') }}" class="nav-link {{ $activePage == 'user' ? ' active' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            <p>
            {{ __('User') }}
            </p>
        </a>
    </li>
    @endcan
    @can('role-list')
    <li class="nav-item">
        <a href="{{ route('roles.index') }}" class="nav-link {{ $activePage == 'role' ? ' active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
            {{ __('Role') }}
            </p>
        </a>
    </li>
    @endcan
    @can('main-service-list')
    <li class="nav-item">
        <a href="{{ route('main_services.index') }}" class="nav-link {{ $activePage == 'main_service' ? ' active' : '' }}">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
            {{ __('Main Service') }}
            </p>
        </a>
    </li>
    @endcan

    @can('category-list')
    <li class="nav-item">
        <a href="{{ route('categories.index') }}" class="nav-link {{ $activePage == 'category' ? ' active' : '' }}">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
            {{ __('Category') }}
            </p>
        </a>
    </li>
    @endcan
</li>