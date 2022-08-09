<!DOCTYPE html>
<html lang="en">

@include('client.partials.header')

<body>

    <div class="page-wrapper">


        <!-- Preloader -->
        <div class="preloader">
            {{-- <div class="icon" style="background-image: {{setting('app.logo')}}"></div> --}}
        </div>

        @include('client.partials.navigation')

        @include('client.partials.search')

        @yield('content')

        @include('client.partials.footer')

        @if(!Request::cookie('cookie_consent'))
            @include('client.partials.consent')
        @endif

    </div>
    <!--End pagewrapper-->

    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>

    @include('client.partials.scripts')

</body>



</html>
