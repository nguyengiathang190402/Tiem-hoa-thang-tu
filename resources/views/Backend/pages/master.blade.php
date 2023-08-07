<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>@yield('title', 'Dashboard')</title>
    @section('style')
        @include('Backend.pages.style')
    @show
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        @include('Backend.pages.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('Backend.pages.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    @yield('content')
                    @include('Backend.pages.footer')

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
    </div>
    <!-- ./wrapper -->
    @section('script')
        @include('Backend.pages.script')
            
    @show
    {{-- @include('Backend.pages.toastr') --}}
</body>

</html>
