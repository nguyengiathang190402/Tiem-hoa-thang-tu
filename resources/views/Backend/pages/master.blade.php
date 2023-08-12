<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>@yield('title', 'Dashboard')</title>
    @section('style')
        @include('Backend.pages.style')
    @show
    
</head>

<body class="g-sidenav-show  bg-gray-200">
        <!-- Navbar -->
        @include('Backend.pages.sidebar')
        <!-- /.navbar -->
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Main Sidebar Container -->
        @include('Backend.pages.navbar')

        <!-- Content Wrapper. Contains page content -->
        <div class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
            
            <!-- Main content -->
            <section class="content">
                    <!-- Small boxes (Stat box) -->
                    @yield('content')
                    @include('Backend.pages.footer')

            
            </section>
            <!-- /.content -->
        </div>
    
    <!-- ./wrapper -->
    @section('script')
        @include('Backend.pages.script')
            
    @show
    @yield('scripts')
    {{-- @include('Backend.pages.toastr') --}}
</body>

</html>
