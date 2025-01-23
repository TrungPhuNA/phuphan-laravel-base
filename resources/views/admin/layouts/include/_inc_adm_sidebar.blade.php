<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class='sidebar-brand' href='/'>
					<span class="sidebar-brand-text align-middle">
						{{ auth()->user()->name ?? "N\A" }}
						<sup><small class="badge bg-primary text-uppercase">123code.net</small></sup>
					</span>
            <svg class="sidebar-brand-icon align-middle" width="32px" height="32px" viewBox="0 0 24 24" fill="none"
                 stroke="#FFFFFF" stroke-width="1.5"
                 stroke-linecap="square" stroke-linejoin="miter" color="#FFFFFF" style="margin-left: -3px">
                <path d="M12 4L20 8.00004L12 12L4 8.00004L12 4Z"></path>
                <path d="M20 12L12 16L4 12"></path>
                <path d="M20 16L12 20L4 16"></path>
            </svg>
        </a>

        <div class="sidebar-user">
            <div class="d-flex justify-content-center">
                <div class="flex-shrink-0">
                    <img src="https://123code.net/images/favicon.png" class="avatar img-fluid rounded me-1" alt="Charles Hall"/>
                </div>
                <div class="flex-grow-1 ps-2">
                    <a class="sidebar-user-title dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Base Core
                    </a>
                    <div class="dropdown-menu dropdown-menu-start">
                        <a class='dropdown-item' href='/pages-profile'><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                        <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i>Analytics</a>
                        <div class="dropdown-divider"></div>
                        <a class='dropdown-item' href='{{ route("admin.setting") }}' title="Cấu hình"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route("auth.logout") }}" title="Đăng xuất">
                            <i class="align-middle me-1" data-feather="log-out"></i> Đăng xuất
                        </a>
                    </div>

                    <div class="sidebar-user-subtitle">Develop</div>
                </div>
            </div>
        </div>

        <ul class="sidebar-nav">
            @foreach(config('setting.admin.menu_sidebar') ?? [] as $itemMenu)
                @if($itemMenu["type"] == 1)
                    <li class="sidebar-header">{{ $itemMenu["name"] }}</li>
                @else
                    @if(empty($itemMenu["sub_menu"]))
                        <li class="sidebar-item {{ Request::is(trim(route($itemMenu['route'], [], false), '/').'/*') || Request::is(trim(route($itemMenu['route'], [], false), '/')) ? 'active' : '' }}">
                            <a class='sidebar-link' href="{{ route($itemMenu['route']) }}" title="{{ $itemMenu['name'] }}">
                                <i class="align-middle" data-feather="{{ $itemMenu['icon'] }}"></i>
                                <span class="align-middle">{{ $itemMenu['name'] }}</span>
                            </a>
                        </li>
                    @else
                        <li class="sidebar-item {{ collect($itemMenu['sub_menu'])->pluck('route')->filter(function ($subRoute) {
                return Request::is(trim(route($subRoute, [], false), '/').'/*') || Request::is(trim(route($subRoute, [], false), '/'));
            })->isNotEmpty() ? 'active' : '' }}">
                            <a data-bs-target="#{{ $itemMenu['id'] }}" data-bs-toggle="collapse" class="sidebar-link {{ collect($itemMenu['sub_menu'])->pluck('route')->filter(function ($subRoute) {
                    return Request::is(trim(route($subRoute, [], false), '/').'/*') || Request::is(trim(route($subRoute, [], false), '/'));
                })->isNotEmpty() ? '' : 'collapsed' }}">
                                <i class="align-middle" data-feather="{{ $itemMenu['icon'] }}"></i>
                                <span class="align-middle">{{ $itemMenu['name'] }}</span>
                            </a>
                            <ul id="{{ $itemMenu['id'] }}" class="sidebar-dropdown list-unstyled collapse {{ collect($itemMenu['sub_menu'])->pluck('route')->filter(function ($subRoute) {
                    return Request::is(trim(route($subRoute, [], false), '/').'/*') || Request::is(trim(route($subRoute, [], false), '/'));
                })->isNotEmpty() ? 'show' : '' }}" data-bs-parent="#sidebar">
                                @foreach($itemMenu['sub_menu'] ?? [] as $subMenu)
                                    <li class="sidebar-item {{ Request::is(trim(route($subMenu['route'], [], false), '/').'/*') || Request::is(trim(route($subMenu['route'], [], false), '/')) ? 'active' : '' }}">
                                        <a class='sidebar-link' href='{{ route($subMenu['route']) }}'>{{ $subMenu['name'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endif
            @endforeach

        </ul>

        <div class="sidebar-cta">
            <div class="sidebar-cta-content">
                <strong class="d-inline-block mb-2">Support</strong>
                <div class="mb-3 text-sm">
                    Cần support hướng dẫn đồ án liên hệ
                </div>

                <div class="d-grid">
                    <a href="https://www.facebook.com/TrungPhuNA" class="btn btn-outline-primary" target="_blank">Phú Phan</a>
                </div>
            </div>
        </div>
    </div>
</nav>