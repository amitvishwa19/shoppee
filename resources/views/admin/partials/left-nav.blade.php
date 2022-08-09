<!-- Left Sidenav -->
<div class="left-sidenav">
    <!-- LOGO -->
    <div class="brand mt-2">
        <a href="{{route('admin.dashboard')}}" class="logo">
            <span class="admin-sidebar-logo-title">
                @if(setting('app_icon'))
                <img src="{{setting('app_icon')}}" alt="logo-small" class="logo-sm">
                @else
                <span class="title-text">{{setting('app_name')}}</span>
                @endif
            </span>
            {{-- <span>
                <img src="{{asset('public/admin/assets/images/logo.png')}}" alt="logo-large" class="logo-lg logo-light">
                <img src="{{asset('public/admin/assets/images/logo-dark.png')}}" alt="logo-large" class="logo-lg logo-dark">
            </span> --}}
        </a>
    </div>
    <!--end logo-->
    <div class="menu-content h-100" data-simplebar>
        <ul class="metismenu left-sidenav-menu">
            
            <li>
                <a href="{{route('admin.dashboard')}}">
                     <i data-feather="home" class="align-self-center menu-icon"></i><span>Dashboard</span>
                </a>
            </li>

            <hr class="hr-dashed hr-menu">
            <li>
                <a href="{{route('post.index')}}">
                     <i data-feather="send" class="align-self-center menu-icon"></i><span>Posts</span>
                </a>
            </li>
            <li>
                <a href="{{route('category.index')}}">
                     <i data-feather="pause" class="align-self-center menu-icon"></i><span>Category</span>
                </a>
            </li>
            <li>
                <a href="">
                     <i data-feather="grid" class="align-self-center menu-icon"></i><span>Sliders</span>
                </a>
            </li>
            <li>
                <a href="{{route('product.index')}}">
                     <i data-feather="server" class="align-self-center menu-icon"></i><span>Products</span>
                </a>
            </li>
            <li>
                <a href="">
                     <i data-feather="gift" class="align-self-center menu-icon"></i><span>Wishlists</span>
                </a>
            </li>
            <li>
                <a href="">
                     <i data-feather="shopping-bag" class="align-self-center menu-icon"></i><span>Carts</span>
                </a>
            </li>
            <li>
                <a href="">
                     <i data-feather="archive" class="align-self-center menu-icon"></i><span>Orders</span>
                </a>
            </li>
            <li>
                <a href="{{route('fcm')}}">
                     <i data-feather="globe" class="align-self-center menu-icon"></i><span>Push Notification</span>
                </a>
            </li>


            <hr class="hr-dashed hr-menu">

            <li>
                <a href="javascript: void(0);"><i data-feather="key" class="align-self-center menu-icon"></i><span>Access Control</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{route('user.index')}}">
                            <i class="ti-control-record"></i>Users</a>
                    </li>

                    <li>
                        <a href="{{route('role.index')}}">
                            <i class="ti-control-record"></i>Roles</a>
                    </li>

                    <li>
                        <a href="{{route('permission.index')}}">
                            <i class="ti-control-record"></i>Permissions</a>
                    </li>

                </ul>
            </li>



            <hr class="hr-dashed hr-menu">

            

        
            <li>
                <a href="{{route('activity.index')}}">
                    <i data-feather="activity" class="align-self-center menu-icon"></i><span>Activity Logs</span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.logs')}}">
                    <i data-feather="alert-triangle" class="align-self-center menu-icon"></i><span>Error Logs</span>
                </a>
            </li>

            <li>
                <a href="{{route('setting.index')}}">
                    <i data-feather="settings" class="align-self-center menu-icon"></i><span>Settings</span>
                </a>
            </li>

        </ul>

        <!-- <div class="update-msg text-center">
            <a href="javascript: void(0);" class="btn btn-outline-warning btn-sm"> &copy; 2021 Devlomatix Solutions Version: {{config('app.version')}}</a>
        </div> -->
    </div>
</div>
<!-- end left-sidenav-->
