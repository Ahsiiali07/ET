<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">
            <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{url('/home')}}">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{route('users')}}">
                    <i class="nav-icon i-Conference"></i>
                    <span class="nav-text">Users</span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item {{ request()->is('categories*') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{route('categories')}}">
                    <i class="nav-icon i-Aim"></i>
                    <span class="nav-text">Categories</span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item {{ request()->is('districts*') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{route('districts')}}">
                    <i class="nav-icon i-Aim"></i>
                    <span class="nav-text">Districts</span>
                </a>
                <div class="triangle"></div>
            </li>
{{--            <li class="nav-item {{ request()->is('shop*') ? 'active' : '' }}">--}}
{{--                <a class="nav-item-hold" href="{{route('shops')}}">--}}
{{--                    <i class="nav-icon i-Shop"></i>--}}
{{--                    <span class="nav-text">Coffee Shops</span>--}}
{{--                </a>--}}
{{--                <div class="triangle"></div>--}}
{{--            </li>--}}

            <li class="nav-item {{ request()->is('place*') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{route('places')}}">
                    <i class="nav-icon i-Shop"></i>
                    <span class="nav-text">Places</span>
                </a>
                <div class="triangle"></div>
            </li>

{{--            <li class="nav-item {{ request()->is('restaurant*') ? 'active' : '' }}">--}}
{{--                <a class="nav-item-hold" href="{{route('restaurants')}}">--}}
{{--                    <i class="nav-icon i-Hotel"></i>--}}
{{--                    <span class="nav-text">Restaurants</span>--}}
{{--                </a>--}}
{{--                <div class="triangle"></div>--}}
{{--            </li>--}}

{{--            <li class="nav-item {{ request()->is('breakfast*') ? 'active' : '' }}">--}}
{{--                <a class="nav-item-hold" href="{{route('breakfast')}}">--}}
{{--                    <i class="nav-icon i-Cardiovascular"></i>--}}
{{--                    <span class="nav-text">Breakfast</span>--}}
{{--                </a>--}}
{{--                <div class="triangle"></div>--}}
{{--            </li>--}}
{{--            <li class="nav-item {{ request()->is('sightseeing*') ? 'active' : '' }}">--}}
{{--                <a class="nav-item-hold" href="{{route('sightseeing')}}">--}}
{{--                    <i class="nav-icon i-Cardiovascular"></i>--}}
{{--                    <span class="nav-text">Sightseeing</span>--}}
{{--                </a>--}}
{{--                <div class="triangle"></div>--}}
{{--            </li>--}}

{{--            <li class="nav-item {{ request()->is('countries*') ? 'active' : '' }}">--}}
{{--                <a class="nav-item-hold" href="{{route('countries')}}">--}}
{{--                    <i class="nav-icon i-Shop"></i>--}}
{{--                    <span class="nav-text">Countries</span>--}}
{{--                </a>--}}
{{--                <div class="triangle"></div>--}}
{{--            </li>--}}

            <li class="nav-item {{ request()->is('send-notification*') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{route('send-notification')}}">
                    <i class="nav-icon i-Gear-2"></i>
                    <span class="nav-text">Send Notification</span>
                </a>
                <div class="triangle"></div>
            </li>



            <li class="nav-item {{ request()->is('content-management*') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{route('cms')}}">
                    <i class="nav-icon i-Gear-2"></i>
                    <span class="nav-text">Content Management</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('support*') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{url('support')}}">
                    <i class="nav-icon i-Support"></i>
                    <span class="nav-text">Support</span>
                </a>
                <div class="triangle"></div>
            </li>
        </ul>
    </div>

    <div class="sidebar-overlay"></div>
</div>
<!--=============== Left side End ================-->
