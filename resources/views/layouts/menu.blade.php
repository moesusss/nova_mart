<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ $activePage == 'dashboard' ? ' active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
        {{ __('Dashboard') }}
        </p>
    </a>
    <li class="nav-item">
        <a href="{{ route('roles.index') }}" class="nav-link {{ $activePage == 'role' ? ' active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
            {{ __('Role') }}
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('main_services.index') }}" class="nav-link {{ $activePage == 'main_service' ? ' active' : '' }}">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
            {{ __('Main Service') }}
            </p>
        </a>
    </li>
</li>