<div class="top-bar color-scheme-transparent">
    <div class="top-menu-controls">
        <div class=""></div>
        <notification></notification>

        @auth
        <div class="logged-user-w">
            <div class="logged-user-i">
                <div class="avatar-w"><img alt="" src="{{asset('storage/'.Auth::user()->pic)}}"></div>
                <div class="logged-user-menu color-style-bright">
                    <div class="logged-user-avatar-info">
                        <div class="avatar-w"><img alt="" src="{{asset('storage/'.Auth::user()->pic)}}"></div>
                        <div class="logged-user-info-w">
                            <div class="logged-user-name" style="width: 70px;">{{ Auth::user()->name }}</div>
                            <div class="logged-user-role">{{ Auth::user()->roles->first()->name }}</div>
                        </div>
                    </div>
                    <div class="bg-icon"><i class="os-icon os-icon-wallet-loaded"></i></div>

                    <ul>

                        <li><a href="{{url('admin/user/profile/edit',['userid'=>Auth::user()->id])}}"><i class="os-icon os-icon-user-male-circle2"></i><span>Profile
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                    </ul>

                </div>
            </div>
        </div>
        @endauth
    </div>
</div>
