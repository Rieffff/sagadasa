<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description"
    content="Multipurpose, super flexible, powerful, clean modern responsive bootstrap 5 admin template">
  <meta name="keywords"
    content="admin template, ra-admin admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="la-themes">
  <link rel="icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/x-icon">
  <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/x-icon">

  <title>  
        @if (trim($__env->yieldContent('title')))
        @yield('title') | {{ config('app.name') }}
        @else
        {{ config('app.name') }}
        @endif</title>

  <!--font-awesome-css-->
  
  <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/css/all.css') }}">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/@phosphor-icons/web@2.0.3/src/light/style.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatable/jquery.dataTables.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/tabler-icons/tabler-icons.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/phosphor/phosphor-duotone.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/phosphor/phosphor-light.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/phosphor/phosphor-bold.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/phosphor/photoshoper.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/phosphor/phosphoe-fill.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/phosphor/phosphor-thin.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/animation/animate.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/flag-icons-master/flag-icon.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/simplebar/simplebar.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
  
  <!-- toastify css-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/toastify/toastify.css') }}">
  <!-- flatpickr css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datepikar/flatpickr.min.css') }}">
  <!-- glight css -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/glightbox/glightbox.min.css') }}">
  <!-- apexcharts css-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/apexcharts/apexcharts.css') }}">
  <style>
    .input-hidden{
      display:none;
    }
    .label-hidden{
      display:block;
    }

  </style>

</head>

<body>
  <div class="app-wrapper">

    <div class="loader-wrapper">
      <div class="app-loader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>

    @include('layouts.nav')


    <div class="app-content">
      <div class="">

        <!-- Header Section starts -->
        <header class="header-main">
          <div class="container-fluid">
            <div class="row">
              <div class="col-6 col-sm-4 d-flex align-items-center header-left p-0">
                <span class="header-toggle me-3">
                  <i class="ph ph-circles-four"></i>
                </span>
              </div>

              <div class="col-6 col-sm-8 d-flex align-items-center justify-content-end header-right p-0">

                <ul class="d-flex align-items-center">

                  <!-- <li class="header-cloud">
                    <a href="#" class="head-icon" role="button" data-bs-toggle="offcanvas"
                       data-bs-target="#cloudoffcanvasTops" aria-controls="cloudoffcanvasTops">
                      <i class="ph-duotone  ph-cloud-sun text-primary f-s-26 me-1"></i>
                      <span>26 <sup class="f-s-10">°C</sup></span>
                    </a>

                    <div class="offcanvas offcanvas-end header-cloud-canvas" tabindex="-1" id="cloudoffcanvasTops"
                         aria-labelledby="cloudoffcanvasTops">
                      <div class="offcanvas-body p-0">
                        <div class="cloud-body">

                          <div class="cloud-content-box">
                            <div class="cloud-box bg-primary-900">
                              <p class="mb-3">Mon</p>
                              <h6 class="mt-4 f-s-13"> +29°C</h6>
                              <span>
                                <i class="ph-duotone  ph-cloud-fog text-white f-s-25"></i>
                              </span>
                              <p class="f-s-13 mt-3"><i class="wi wi-raindrop"></i> 2%</p>
                            </div>
                            <div class="cloud-box bg-primary-800">
                              <p class="mb-3">Tue</p>
                              <h6 class="mt-4 f-s-13"> +29°C</h6>
                              <span>
                                <i class="ph-duotone  ph-cloud-sun text-white f-s-25"></i>
                              </span>
                              <p class="f-s-13 mt-3"><i class="wi wi-raindrop"></i> 2%</p>
                            </div>
                            <div class="cloud-box bg-primary-700">
                              <p class="mb-3 text-light">Wed</p>
                              <h6 class="mt-4 f-s-13"> +20°C</h6>
                              <span>
                                <i class="ph-duotone  ph-sun-dim text-white f-s-25"></i>
                              </span>
                              <p class="f-s-13 mt-3"><i class="wi wi-raindrop"></i> 1%</p>
                            </div>
                            <div class="cloud-box bg-primary-600">
                              <p class="mb-3">Thu</p>
                              <h6 class="mt-4 f-s-13"> +17°C</h6>
                              <span>
                                <i class="ph-duotone  ph-sun-dim text-white f-s-25"></i>
                              </span>
                              <p class="f-s-13 mt-3"><i class="wi wi-raindrop"></i> 1%</p>
                            </div>
                            <div class="cloud-box bg-primary-500">
                              <p class="mb-3">Fri</p>
                              <h6 class="mt-4 f-s-13"> +18°C</h6>
                              <span>
                                <i class="ph-duotone  ph-sun-dim text-white f-s-25"></i>
                              </span>
                              <p class="f-s-13 mt-3"><i class="wi wi-raindrop"></i> 1%</p>
                            </div>
                            <div class="cloud-box bg-primary-400">
                              <p class="mb-3">Sat</p>
                              <h6 class="mt-4 f-s-13"> +16°C</h6>
                              <span>
                                <i class="ph-duotone  ph-sun-dim text-white f-s-25"></i>
                              </span>
                              <p class="f-s-13 mt-3"><i class="wi wi-raindrop"></i> 1%</p>
                            </div>
                            <div class="cloud-box bg-primary-300">
                              <p class="mb-3">Sun</p>
                              <h6 class="mt-4 f-s-13"> +29°C</h6>
                              <span class="mb-3">
                                <i class="ph-duotone  ph-sun-dim text-white f-s-25"></i>
                              </span>
                              <p class="f-s-13 mt-3"><i class="wi wi-raindrop"></i> 1%</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li> -->
                  <li class="header-dark">
                    <div class="sun-logo head-icon">
                      <i class="ph ph-moon-stars"></i>
                    </div>
                    <div class="moon-logo head-icon">
                      <i class="ph ph-sun-dim"></i>
                    </div>
                  </li>

                  

                  <li class="header-profile">
                    <a href="#" class="d-block head-icon" role="button" data-bs-toggle="offcanvas"
                       data-bs-target="#profilecanvasRight" aria-controls="profilecanvasRight">
                      <img src="{{ asset('assets/images/avtar/woman.jpg') }}" alt="avtar" class="b-r-10 h-35 w-35">
                    </a>

                    <div class="offcanvas offcanvas-end header-profile-canvas" tabindex="-1" id="profilecanvasRight"
                         aria-labelledby="profilecanvasRight">
                      <div class="offcanvas-body app-scroll">
                        <ul class="">
                          <li>
                            <div class="d-flex-center">
                              <span class="h-45 w-45 d-flex-center b-r-10 position-relative">
                                <img src="{{ asset('assets/images/avtar/woman.jpg') }}" alt="" class="img-fluid b-r-10">
                              </span>
                            </div>
                            <div class="text-center mt-2">
                              <h6 class="mb-0"> {{ auth()->user()->name; }}</h6>
                              <p class="f-s-12 mb-0 text-secondary">{{ auth()->user()->email; }}</p>
                            </div>
                          </li>

                          <li class="app-divider-v dotted py-1"></li>
                          <li>
                            <a class="f-w-500" href="#" target="_blank">
                              <i class="ph-duotone  ph-user-circle pe-1 f-s-20"></i> Profile Details
                            </a>
                          </li>
                          <li>
                            <a class="f-w-500" href="#" target="_blank">
                              <i class="ph-duotone  ph-gear pe-1 f-s-20"></i> Settings
                            </a>
                          </li>
                          <li>
                            <a class="f-w-500" href="{{ route('logout') }}">
                              <i class="ph-duotone  ph-sign-out pe-1 f-s-20"></i> Sign Out
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </header>
        <!-- Header Section ends -->

        <!-- Body main section starts -->
      
        @yield('content')
        <!-- Body main section ends -->

        <!-- tap on top -->
        <div class="go-top">
          <span class="progress-value">
            <i class="ti ti-arrow-up"></i>
          </span>
        </div>

        <!-- Footer Section starts-->
        <footer>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-9 col-12">
                <ul class="footer-text">
                  <li>
                    <p class="mb-0">Copyright © 2024 sagadasa. All rights reserved 💖</p>
                  </li>
                  <li> <a href="#"> V1.0.0 </a></li>
                </ul>
              </div>
              <div class="col-md-3">
                <ul class="footer-text text-end">
                  <li> <a href="#"> Need Help <i class="ti ti-help"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
        <!-- Footer Section ends-->
        
      </div>
    </div>
  </div>
  


  <!--customizer-->
  <div id="customizer"></div>

  <script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/simplebar/simplebar.js') }}"></script>
  <script src="{{ asset('assets/vendor/phosphor/phosphor.js') }}"></script>
  <script src="{{ asset('assets/js/phosphor.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatable/jquery.dataTables.min.js') }}"></script> 
  <script src="{{ asset('assets/js/data_table.js') }}"></script>
  <script src="{{ asset('assets/js/script.js') }}"></script>
  <script src="{{ asset('assets/js/customizer.js') }}"></script>

<!-- apexcharts-->
<script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>

<!-- js-->
<script src="{{ asset('assets/js/line.js') }}"></script>
  <!--js-->
  <script src="{{ asset('assets/vendor/datepikar/flatpickr.js') }}"></script>
  <script src="{{ asset('assets/js/date_picker.js') }}"></script>
  <!-- js -->
  <script src="{{ asset('assets/js/form_wizard_2.js') }}"></script>
  
  <!-- Toatify js-->
  <script src="{{ asset('assets/vendor/notifications/toastify-js.js') }}"></script>
  <script src="{{ asset('assets/vendor/toastify/toastify.js') }}"></script>
  <script src="{{ asset('assets/js/tooltips_popovers.js')}}"></script>
  <script src="{{ asset('assets/js/notifications.js')}}"></script>
  <!-- sweetalert js-->
  <script src="{{ asset('assets/vendor/sweetalert/sweetalert.js') }}"></script>
  
  <!-- Glight js -->
  <script src="{{ asset('assets/vendor/glightbox/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/masonry/masonry.pkgd.min.js') }}"></script>
  
  <!-- js -->
  <script src="{{ asset('assets/js/glightbox.js') }}"></script>
  <script>
    const Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
      }
    });

    function pemberitahuan(ikon, pesan){
      return Toast.fire({icon: ikon,title: pesan });
    }

    function konfirmasi(){
      return Swal.fire({
                title: "Apakah Anda Yakin?",
                text: "data tidak dapat di pulihkan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Saya yakin !!"
                });
    }
    function konfirmasi2(){
      return Swal.fire({
                title: "Simpan data",
                text: "Periksalah Kembali Sebelum Menyimpan data",
                icon: "info",
                showCancelButton: true,
                confirmButtonText: "Ya, Simpan"
                });
    }

    function pesan(judul,pesan,ikon){

      return Swal.fire({ title: judul,text: pesan ,icon: ikon});
    }
  </script>
  

@stack('other-scripts')
@stack('locations-scripts')
@stack('item-scripts')
@stack('devices-scripts')
@stack('companies-scripts')
@stack('users-scripts')
  
</body>

</html>