<div class="navbar-custom" style="z-index: 1001;">
    <ul class="list-unstyled topnav-menu float-right mb-0">
        @if(auth()->user())
        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{auth()->user()->profile_picture ?? '/assets/images/noimage.jpeg'}}" alt="user-image" class="rounded-circle">
                <span class="pro-user-name ml-1">
                    {{strtok(auth()->user()->name, " ")}} <i class="mdi mdi-chevron-down"></i> 
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome !</h6>
                </div>

                <!-- item-->
                <a href="/profile" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span>Profile</span>
                </a>

                <div class="dropdown-divider"></div>

                <!-- item-->
                <a href="javascript:void(0);" onclick="logout()" class="dropdown-item notify-item">
                    <i class="fe-log-out"></i>
                    <span>Logout</span>
                </a>

            </div>
        </li>
        @else
        <li class="dropdown notification-list">
            <a href="/login" class="nav-link right-bar-toggle waves-effect">
                <i class="fe-log-in"></i>
            </a>
        </li>
        @endif
    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        @if($setting->logo && $setting->small_logo)
        <a href="/" class="logo logo-dark text-center">
            @if($setting->logo)
            <span class="logo-lg">
                <img src="{{url($setting->logo)}}" alt="" height="50">
            </span>
            @endif
            @if($setting->small_logo)
            <span class="logo-sm">
                <img src="{{url($setting->small_logo)}}" alt="" height="24">
            </span>
            @endif
        </a>
        <a href="/" class="logo logo-light text-center">
            @if($setting->logo)
            <span class="logo-lg">
                <img src="{{url($setting->logo)}}" alt="" height="50">
            </span>
            @endif
            @if($setting->small_logo)
            <span class="logo-sm">
                <img src="{{url($setting->small_logo)}}" alt="" height="24">
            </span>
            @endif
        </a>
        @endif
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
        <li>
            <button class="button-menu-mobile disable-btn waves-effect">
                <i class="fe-menu"></i>
            </button>
        </li>

        <li>
            <h4 class="page-title-main">{{ $alt_title ?? ($title ?? '')}}</h4>
        </li>

    </ul>

</div>