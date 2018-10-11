  <!--------------------
START - Top Bar
-------------------->
<div class="top-bar color-scheme-transparent">
    <!--------------------
START - Top Menu Controls
-------------------->
    <div class="top-menu-controls">
        <div class="element-search autosuggest-search-activator"><input placeholder="Start typing to search..."
                type="text"></div>
        <!--------------------
START - Messages Link in secondary top menu
-------------------->
<notification></notification>

        <!--------------------
END - Messages Link in secondary top menu
-------------------->
        <!--------------------
START - Settings Link in secondary top menu
-------------------->
        {{-- <div class="top-icon top-settings os-dropdown-trigger os-dropdown-position-left"><i class="os-icon os-icon-ui-46"></i>
            <div class="os-dropdown">
                <div class="icon-w"><i class="os-icon os-icon-ui-46"></i></div>
                <ul>
                    <li><a href="users_profile_small.html"><i class="os-icon os-icon-ui-49"></i><span>Profile
                                Settings</span></a></li>
                    <li><a href="users_profile_small.html"><i class="os-icon os-icon-grid-10"></i><span>Billing
                                Info</span></a></li>
                    <li><a href="users_profile_small.html"><i class="os-icon os-icon-ui-44"></i><span>My
                                Invoices</span></a></li>
                    <li><a href="users_profile_small.html"><i class="os-icon os-icon-ui-15"></i><span>Cancel
                                Account</span></a></li>
                </ul>
            </div>
        </div> --}}
        <!--------------------
END - Settings Link in secondary top menu
-------------------->
        <!--------------------
START - User avatar and menu in secondary top menu
-------------------->

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
                                    Details</span></a></li>
                        <li><a href="users_profile_small.html"><i class="os-icon os-icon-coins-4"></i><span>Billing
                                    Details</span></a></li>
                        <li><a href="#"><i class="os-icon os-icon-others-43"></i><span>Notifications</span></a></li>
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
        <!--------------------
END - User avatar and menu in secondary top menu
-------------------->
    </div>
    <!--------------------
END - Top Menu Controls
-------------------->
</div>
<!--------------------
END - Top Bar
-------------------->