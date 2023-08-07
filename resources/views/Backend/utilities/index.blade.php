<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin/assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{ asset('admin/assets/img/favicon.png')}}">
  <title>
    Tiện ích
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('admin/assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{ asset('admin/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('admin/assets/css/material-dashboard.css?v=3.1.0')}}" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-200 virtual-reality">
  <div class="mt-n3">
    <!-- Navbar -->
    @include('Backend.pages.navbar')
    <!-- End Navbar -->
  </div>
  <div class="border-radius-xl mx-2 mx-md-3 position-relative" style="background-image: url('{{ asset('admin/assets/img/vr-bg.jpg')}}'); background-size: cover;">
    @include('Backend.pages.sidebar')
    <main class="main-content border-radius-lg h-100">
      <div class="section min-vh-85 position-relative transform-scale-0 transform-scale-md-7">
        <div class="container-fluid">
          <div class="row pt-10">
            <div class="col-lg-1 col-md-1 pt-5 pt-lg-0 ms-lg-5 text-center">
              <a href="javascript:;" class="avatar avatar-lg border-0 p-1" data-bs-toggle="tooltip" data-bs-placement="right" title="My Profile">
                <img class="border-radius-lg" alt="Image placeholder" src="{{ asset('admin/assets/img/1.jpeg')}}">
              </a>
              <button class="btn btn-white border-radius-lg p-2 mt-n4 mt-md-2" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="Home">
                <i class="material-icons p-2">home</i>
              </button>
              <button class="btn btn-white border-radius-lg p-2 mt-n4 mt-md-0" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="Search">
                <i class="material-icons p-2">search</i>
              </button>
              <button class="btn btn-white border-radius-lg p-2 mt-n4 mt-md-0" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="Minimize">
                <i class="material-icons p-2">more_horiz</i>
              </button>
            </div>
            <div class="col-lg-8 col-md-11 ps-md-5 mb-5 mb-md-0">
              <div class="d-flex">
                <div class="me-auto">
                  <h1 class="display-1 font-weight-bold mt-n3 mb-0 text-white">28°C</h1>
                  <h6 class="text-uppercase mb-0 ms-1 text-white">Cloudy</h6>
                </div>
                <div class="ms-auto">
                  <img class="w-50 float-end mt-n6 mt-lg-n4" src="{{ asset('admin/assets/img/small-logos/icon-sun-cloud.png')}}" alt="image sun">
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-lg-4 col-md-6">
                  <div class="card move-on-hover overflow-hidden">
                    <div class="card-body">
                      <div class="d-flex">
                        <h6 class="mb-0 me-3">08:00</h6>
                        <h6 class="mb-0">Synk up with Mark
                          <small class="text-secondary font-weight-normal">Hangouts</small>
                        </h6>
                      </div>
                      <hr class="horizontal dark">
                      <div class="d-flex">
                        <h6 class="mb-0 me-3">09:30</h6>
                        <h6 class="mb-0">Gym <br />
                          <small class="text-secondary font-weight-normal">World Class</small>
                        </h6>
                      </div>
                      <hr class="horizontal dark">
                      <div class="d-flex">
                        <h6 class="mb-0 me-3">11:00</h6>
                        <h6 class="mb-0">Design Review<br />
                          <small class="text-secondary font-weight-normal">Zoom</small>
                        </h6>
                      </div>
                    </div>
                    <a href="javascript:;" class="bg-gray-100 w-100 text-center py-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Show More">
                      <i class="material-icons text-primary">expand_more</i>
                    </a>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 mt-4 mt-sm-0">
                  <div class="card bg-gradient-dark move-on-hover">
                    <div class="card-body">
                      <div class="d-flex">
                        <h5 class="mb-0 text-white">To Do</h5>
                        <div class="ms-auto">
                          <h1 class="text-white text-end mb-0 mt-n2">7</h1>
                          <p class="text-sm mb-0 text-white">items</p>
                        </div>
                      </div>
                      <p class="text-white mb-0">Shopping</p>
                      <p class="mb-0 text-white">Meeting</p>
                    </div>
                    <a href="javascript:;" class="w-100 text-center py-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Show More">
                      <i class="material-icons text-white">expand_more</i>
                    </a>
                  </div>
                  <div class="card move-on-hover mt-4">
                    <div class="card-body">
                      <div class="d-flex">
                        <p class="mb-0">Emails (21)</p>
                        <a href="javascript:;" class="ms-auto" data-bs-toggle="tooltip" data-bs-placement="top" title="Check your emails">
                          Check
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-12 mt-4 mt-lg-0">
                  <div class="card card-background card-background-mask-dark move-on-hover align-items-start">
                    <div class="cursor-pointer">
                      <div class="full-background" style="background-image: url('https://images.unsplash.com/photo-1470813740244-df37b8c1edcb?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=600&q=80')"></div>
                      <div class="card-body">
                        <video controls loop width="130" height="200">
                            <source src="{{ asset('admin/assets/media/emyeu.mp4')}}">
                          </video>
                      </div>
                    </div>
                  </div>
                  <div class="card move-on-hover mt-4">
                    <div class="card-body">
                      <div class="d-flex">
                        <p class="my-auto">Messages</p>
                        <div class="ms-auto">
                          <div class="avatar-group">
                            <a href="javascript:;" class="avatar avatar-sm border-0 rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="2 New Messages">
                              <img alt="Image placeholder" src="{{ asset('admin/assets/img/team-1.jpg')}}">
                            </a>
                            <a href="javascript:;" class="avatar avatar-sm border-0 rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="1 New Message">
                              <img alt="Image placeholder" src="{{ asset('admin/assets/img/team-2.jpg')}}">
                            </a>
                            <a href="javascript:;" class="avatar avatar-sm border-0 rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="13 New Messages">
                              <img alt="Image placeholder" src="{{ asset('admin/assets/img/team-3.jpg')}}">
                            </a>
                            <a href="javascript:;" class="avatar avatar-sm border-0 rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="7 New Messages">
                              <img alt="Image placeholder" src="{{ asset('admin/assets/img/team-4.jpg')}}">
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
  @include('Backend.pages.footer')
  <!--   Core JS Files   -->
  <script src="{{ asset('admin/assets/js/core/popper.min.js')}}"></script>
  <script src="{{ asset('admin/assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{ asset('admin/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{ asset('admin/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('admin/assets/js/material-dashboard.min.js?v=3.1.0')}}"></script>
</body>

</html>