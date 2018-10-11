 <!--------------------
START - Mobile Menu
-------------------->
<div class="menu-mobile menu-activated-on-click color-scheme-dark">
    <div class="mm-logo-buttons-w">
        <a class="mm-logo" href="{{url('/')}}">
            <img src="{{asset('img/logo.svg')}}">
            <span>{{config('app.name')}}</span>
        </a>
        <div class="mm-buttons">
            <div class="content-panel-open">
                <div class="os-icon os-icon-grid-circles"></div>
            </div>
            <div class="mobile-menu-trigger">
                <div class="os-icon os-icon-hamburger-menu-1"></div>
            </div>
        </div>
    </div>
    <div class="menu-and-user">
        <div class="logged-user-w">
            <div class="avatar-w"><img alt="" src="{{asset('storage/'.Auth::user()->pic)}}"></div>
            <div class="logged-user-info-w">
                <div class="logged-user-name">{{Auth::user()->name}}</div>
                <div class="logged-user-role">{{Auth::user()->roles->first()->name}}</div>
            </div>
        </div>

        <ul class="main-menu">
            @ability(env('USER_ROLE'), env('USER_PERMISSION'))

            <li class="has-sub-menu">
                <a href="layouts_menu_top_image.html">
                    <div class="icon-w">
                        <div class="os-icon os-icon-users"></div>
                    </div>
                    <span>Users</span>
                </a>
                <ul class="sub-menu">
                    <li><a href="{{url('admin/users')}}">Users</a></li>
                    <li><a href="{{url('admin/roles')}}">Roles</a></li>
                    <li><a href="{{url('admin/permissions')}}">Permissions</a></li>
                </ul>
            </li>
            @endability
        </ul>
    </div>
</div>
<!--------------------
END - Mobile Menu
-------------------->

<!--------------------
START - Main Menu
-------------------->
<div class="menu-w color-scheme-light color-style-transparent menu-position-side menu-side-left menu-layout-compact sub-menu-style-over sub-menu-color-bright selected-menu-color-light menu-activated-on-hover menu-has-selected-link">
    <div class="logo-w">
        <a href="{{url('/')}}"><img alt="" src="{{asset('img/logo.svg')}}"></a>
        <div class="logo-label">{{config('app.name')}}</div>
    </div>

    <ul class="main-menu">
        @ability(env('USER_ROLE'), env('USER_PERMISSION'))

        <li class="sub-header"><span>System Managment</span></li>
        <li class="has-sub-menu">
            <a href="{{url('admin/users')}}">
                <div class="icon-w">
                    <div class="os-icon os-icon-users"></div>
                </div>
                <span>Users</span>
            </a>

            <div class="sub-menu-w">
                <div class="sub-menu-header">Users</div>
                <div class="sub-menu-icon">
                    <i class="os-icon os-icon-layout"></i>
                </div>
                <div class="sub-menu-i">
                    <ul class="sub-menu">
                        <li><a href="{{url('admin/users')}}">Users</a></li>
                        <li><a href="{{url('admin/roles')}}">Roles</a></li>
                        <li><a href="{{url('admin/permissions')}}">Permissions</a></li>
                    </ul>
                </div>
            </div>
        </li>
        @endability
    </ul>
</div>
<!--------------------
END - Main Menu
-------------------->