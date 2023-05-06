<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="#" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/logo.png') }}" width="40" height="40">
            </span>
            <span class="app-brand-text fw-bolder ms-2">TMC TEST</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <hr>
    
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ Request::segment(1) == 'provinsi' ? 'active' : '' }}">
            <a href="{{ route('provinsi.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Provinsi</div>
            </a>
        </li>
        <li class="menu-item {{ Request::segment(1) == 'kabupaten' ? 'active' : '' }}">
            <a href="{{ route('kabupaten.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Kabupaten</div>
            </a>
        </li>
    </ul>
</aside>
