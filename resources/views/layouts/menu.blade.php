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
            <i class="nav-icon fas fa-copy"></i>
            <p>
            {{ __('Category') }}
            </p>
        </a>
    </li>
    @endcan
    @can('sub-category-list')
    <li class="nav-item">
        <a href="{{ route('sub_categories.index') }}" class="nav-link {{ $activePage == 'sub-category' ? ' active' : '' }}">
            <i class="nav-icon fas fa-columns"></i>
            <p>
            {{ __('Sub Category') }}
            </p>
        </a>
    </li>
    @endcan

    @can('brand-list')
    <li class="nav-item">
        <a href="{{ route('brands.index') }}" class="nav-link {{ $activePage == 'brand' ? ' active' : '' }}">
            <i class="nav-icon fas fa-columns"></i>
            <p>
            {{ __('Brand') }}
            </p>
        </a>
    </li>
    @endcan

    @can('hub-vendor-list')
    <li class="nav-item">
        <a href="{{ route('hub_vendors.index') }}" class="nav-link {{ $activePage == 'hub_vendor' ? ' active' : '' }}">
            <i class="nav-icon fas fa-shield-alt"></i>
            <p>
            {{ __('Hub Vendor') }}
            </p>
        </a>
    </li>
    @endcan

    @can('vendor-list')
    <li class="nav-item">
        <a href="{{ route('vendors.index') }}" class="nav-link {{ $activePage == 'vendor' ? ' active' : '' }}">
            <i class="nav-icon fas fa-table"></i>
            <p>
            {{ __('Vendor') }}
            </p>
        </a>
    </li>
    @endcan

    @can('item-list')
    <li class="nav-item">
        <a href="{{ route('items.index') }}" class="nav-link {{ $activePage == 'item' ? ' active' : '' }}">
            <i class="nav-icon fas fa-table"></i>
            <p>
            {{ __('Item') }}
            </p>
        </a>
    </li>
    @endcan
</li>