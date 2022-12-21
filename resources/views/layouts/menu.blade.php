<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ $activePage == 'dashboard' ? ' active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
        {{ __('Dashboard') }}
        </p>
    </a>
</li>
@can('user-list','role-list') 
<li class="nav-item {{ $activePage == 'user' || $activePage=='role'? ' menu-open' : '' }}">
    <a href="#" class="nav-link {{ $activePage == 'user' || $activePage=='role'? ' active' : '' }}">
    <i class="nav-icon fas fa-users"></i>
        <p>
            {{ __('User') }}
        </p>
        <i class="right fas fa-angle-left"></i>
    </a>
    <ul class="nav nav-treeview">
        @can('user-list')
        <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link {{ $activePage == 'user' ? ' active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>
                {{ __('User') }}
                </p>
            </a>
        </li>
        @endcan
        @can('role-list')
        <li class="nav-item">
            <a href="{{ route('roles.index') }}" class="nav-link {{ $activePage == 'role' ? ' active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>
                {{ __('Role') }}
                </p>
            </a>
        </li>
        @endcan
    </ul>
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
@can('category-list','sub-category-list','brand-list') 
<li class="nav-item {{ $activePage == 'category' || $activePage=='sub-category'||$activePage=='brand'? ' menu-open' : '' }}">
    <a href="#" class="nav-link {{ $activePage == 'category' || $activePage=='sub-category'|| $activePage=='brand'? ' active' : '' }}">
    <i class="nav-icon fas fa-copy"></i>
        <p>
            {{ __('Category') }}
        </p>
        <i class="right fas fa-angle-left"></i>
    </a>
    <ul class="nav nav-treeview">
        @can('category-list')
        <li class="nav-item">
            <a href="{{ route('categories.index') }}" class="nav-link {{ $activePage == 'category' ? ' active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>
                {{ __('Category') }}
                </p>
            </a>
        </li>
        @endcan
        @can('sub-category-list')
        <li class="nav-item">
            <a href="{{ route('sub_categories.index') }}" class="nav-link {{ $activePage == 'sub-category' ? ' active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>
                {{ __('Sub Category') }}
                </p>
            </a>
        </li>
        @endcan
        @can('brand-list')
            <li class="nav-item">
                <a href="{{ route('brands.index') }}" class="nav-link {{ $activePage == 'brand' ? ' active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                    {{ __('Brand') }}
                    </p>
                </a>
            </li>
        @endcan
    </ul>
</li>
@endcan
@can('user-list','role-list') 
<li class="nav-item {{ $activePage == 'hub_vendor' || $activePage=='vendor'? ' menu-open' : '' }}">
    <a href="#" class="nav-link {{ $activePage == 'hub_vendor' || $activePage=='vendor'? ' active' : '' }}">
    <i class="nav-icon fas fa-user"></i>
        <p>
            {{ __('Vendor') }}
        </p>
        <i class="right fas fa-angle-left"></i>
    </a>
    <ul class="nav nav-treeview">
        @can('user-list')
        <li class="nav-item">
            <a href="{{ route('hub_vendors.index') }}" class="nav-link {{ $activePage == 'hub_vendor' ? ' active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>
                {{ __('Hub Vendor') }}
                </p>
            </a>
        </li>
        @endcan
        @can('role-list')
        <li class="nav-item">
        <a href="{{ route('vendors.index') }}" class="nav-link {{ $activePage == 'vendor' ? ' active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>
                {{ __('Vendor') }}
                </p>
            </a>
        </li>
        @endcan
    </ul>
</li>
@endcan
@can('item-list','stock-list') 
<li class="nav-item {{ $activePage == 'item' || $activePage=='item_stock'? ' menu-open' : '' }}">
    <a href="#" class="nav-link {{ $activePage == 'item' || $activePage=='item_stock'? ' active' : '' }}">
    <i class="nav-icon fas fa-table"></i>
        <p>
            {{ __('Item') }}
        </p>
        <i class="right fas fa-angle-left"></i>
    </a>
    <ul class="nav nav-treeview">
        @can('item-list')
        <li class="nav-item">
            <a href="{{ route('items.index') }}" class="nav-link {{ $activePage == 'item' ? ' active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>
                {{ __('Item') }}
                </p>
            </a>
        </li>
        @endcan
        @can('stock-list')
        <li class="nav-item">
        <a href="{{ route('item_stocks.index') }}" class="nav-link {{ $activePage == 'item_stock' ? ' active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>
                {{ __('Item Stock') }}
                </p>
            </a>
        </li>
        @endcan
    </ul>
</li>
@endcan
@can('customer-list')
    <li class="nav-item">
        <a href="{{ route('customers.index') }}" class="nav-link {{ $activePage == 'customer' ? ' active' : '' }}">
            <i class="nav-icon fas fa-user-circle"></i>
            <p>
            {{ __('Customer') }}
            </p>
        </a>
    </li>
@endcan

@can('delivery-fee-list')
    <li class="nav-item">
        <a href="{{ route('delivery_fees.index') }}" class="nav-link {{ $activePage == 'delivery_fee' ? ' active' : '' }}">
            <i class="nav-icon fas fa-bicycle"></i>
            <p>
            {{ __('Delivery Fee') }}
            </p>
        </a>
    </li>
@endcan