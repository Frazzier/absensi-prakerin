<div class="left-side-menu">

    <div class="slimscroll-menu">
        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">
                @if(auth()->user())
                    <li class="menu-title">Menu</li>
                    <li>
                        <a href="/dashboard" @if(request()->segment(1) == 'dashboard') class="active" @endif>
                            <i class="mdi mdi-view-dashboard"></i>
                            <span> Dashboard </span>
                        </a>
                    </li>
                    @include('layouts.sidebar.'.auth()->user()->role)
                @endif
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>