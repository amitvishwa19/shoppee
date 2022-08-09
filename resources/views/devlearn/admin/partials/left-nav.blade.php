<!-- Left Sidenav -->
<div class="left-sidenav">
    <!-- LOGO -->
    <div class="brand mt-2">
        <a href="{{route('admin.dashboard')}}" class="logo">
            <span class="admin-sidebar-logo-title">
                <img src="{{setting('app_fevicon')}}" alt="logo-small" class="logo-sm">
                <span class="title-text">DevLearn</span>
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
                <a href="{{route('devlearn.dashboard')}}">
                     <i data-feather="home" class="align-self-center menu-icon"></i><span>Dashboard</span>
                </a>
            </li>

            <hr class="hr-dashed hr-menu">

            <li>
                <a href="">
                     <i data-feather="users" class="align-self-center menu-icon"></i><span>Students</span>
                </a>
            </li>

            <li>
                <a href="">
                     <i data-feather="users" class="align-self-center menu-icon"></i><span>Teachers</span>
                </a>
            </li>

            <li>
                <a href="">
                     <i data-feather="twitch" class="align-self-center menu-icon"></i><span>Classes</span>
                </a>
            </li>

            <li>
                <a href="">
                     <i data-feather="pause" class="align-self-center menu-icon"></i><span>Courses</span>
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



            

        </ul>

        <!-- <div class="update-msg text-center">
            <a href="javascript: void(0);" class="btn btn-outline-warning btn-sm"> &copy; 2021 Devlomatix Solutions Version: {{config('app.version')}}</a>
        </div> -->
    </div>
</div>
<!-- end left-sidenav-->
