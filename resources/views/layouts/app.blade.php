<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatable/jquery.dataTables.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/tabler-icons/tabler-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/animation/animate.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/flag-icons-master/flag-icon.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/simplebar/simplebar.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">

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

                  <li class="header-cloud">
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
                  </li>

                  <li class="header-language">
                    <div id="lang_selector" class="flex-shrink-0 dropdown">
                      <a href="#" class="d-block head-icon ps-0" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="lang-flag lang-en ">
                          <span class="flag rounded-circle overflow-hidden">
                            <i class=""></i>
                          </span>
                        </div>
                      </a>
                      <ul class="dropdown-menu language-dropdown header-card border-0">
                        <li class="lang lang-en selected dropdown-item p-2" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="US">
                          <span class="d-flex align-items-center">
                            <i class="flag-icon flag-icon-usa flag-icon-squared b-r-10 f-s-22"></i>
                            <span class="ps-2">US</span>
                          </span>
                        </li>
                        <li class="lang lang-pt dropdown-item p-2" title="FR">
                          <span class="d-flex align-items-center">
                            <i class="flag-icon flag-icon-fra flag-icon-squared b-r-10 f-s-22"></i>
                            <span class="ps-2">France</span>
                          </span>
                        </li>
                        <li class="lang lang-es dropdown-item p-2" title="UK">
                          <span class="d-flex align-items-center">
                            <i class="flag-icon flag-icon-gbr flag-icon-squared b-r-10 f-s-22"></i>
                            <span class="ps-2">UK</span>
                          </span>
                        </li>
                        <li class="lang lang-es dropdown-item p-2" title="IT">
                          <span class="d-flex align-items-center">
                            <i class="flag-icon flag-icon-ita flag-icon-squared b-r-10 f-s-22"></i>
                            <span class="ps-2">Italy</span>
                          </span>
                        </li>
                      </ul>
                    </div>

                  </li>

                  <li class="header-searchbar">
                    <a href="#" class="d-block head-icon" role="button" data-bs-toggle="offcanvas"
                       data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                      <i class="ph ph-magnifying-glass"></i>
                    </a>

                    <div class="offcanvas offcanvas-end header-searchbar-canvas" tabindex="-1" id="offcanvasRight"
                         aria-labelledby="offcanvasRight">
                      <div class="header-searchbar-header">
                        <div class="d-flex justify-content-between mb-3">
                          <form class="app-form app-icon-form w-100" action="#">
                            <div class="position-relative">
                              <input type="search" class="form-control search-filter" placeholder="Search..."
                                     aria-label="Search">
                              <i class="ti ti-search text-dark"></i>
                            </div>
                          </form>

                          <div class="app-dropdown flex-shrink-0">
                            <a class="h-35 w-35 d-flex-center b-r-15 overflow-hidden bg-light-secondary search-list-avtar ms-2"
                               href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                               aria-expanded="false">
                              <i class="ph-duotone  ph-gear f-s-20"></i>
                            </a>

                            <ul class="dropdown-menu mb-3">
                              <li class="dropdown-item mt-2">
                                <a href="#">
                                  <h6 class="mb-0">Search Settings</h6>
                                </a>
                              </li>
                              <li class="dropdown-item d-flex align-items-center justify-content-between">
                                <a href="#">
                                  <h6 class="mb-0 text-secondary f-s-14">Safe Search Filtering</h6>
                                </a>
                                <div class="flex-shrink-0">
                                  <div class="form-check form-switch">
                                    <input class="form-check-input form-check-primary" type="checkbox" id="searchSwitch"
                                           checked>
                                  </div>
                                </div>
                              </li>
                              <li class="dropdown-item d-flex align-items-center justify-content-between">
                                <a href="#">
                                  <h6 class="mb-0 text-secondary f-s-14">Search Suggestions</h6>
                                </a>
                                <div class="flex-shrink-0">
                                  <div class="form-check form-switch">
                                    <input class="form-check-input form-check-primary" type="checkbox"
                                           id="searchSwitch1">
                                  </div>
                                </div>
                              </li>
                              <li class="dropdown-item d-flex align-items-center justify-content-between">
                                <h6 class="mb-0 text-secondary f-s-14"> Search History</h6>
                                <i class="ti ti-message-circle me-3  text-success"></i>
                              </li>
                              <li class="dropdown-divider"></li>
                              <li class="dropdown-item d-flex align-items-center justify-content-between mb-2">
                                <a href="#">
                                  <h6 class="mb-0 text-dark f-s-14">Custom Search Preferences</h6>
                                </a>
                                <div class="flex-shrink-0">
                                  <div class="form-check form-switch">
                                    <input class="form-check-input form-check-primary" type="checkbox"
                                           id="searchSwitch2">
                                  </div>
                                </div>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <p class="mb-0 text-secondary f-s-15 mt-2">Recently Searched Data:</p>
                      </div>
                      <div class="offcanvas-body app-scroll p-0">
                        <div>
                          <ul class="search-list">
                            <li class="search-list-item">
                              <div
                                      class="h-35 w-35 d-flex-center b-r-15 overflow-hidden bg-light-secondary search-list-avtar">
                                <i class="ph-duotone  ph-gear f-s-20"></i>
                              </div>
                              <div class="search-list-content">
                                <a href="api.html" target="_blank"><h6 class="mb-0 text-dark">user management</h6></a>
                                <p class="f-s-13 mb-0 text-secondary">#RA789</p>
                              </div>
                            </li>
                            <li class="search-list-item">
                              <div
                                      class="h-35 w-35 d-flex-center b-r-15 overflow-hidden bg-light-warning search-list-avtar">
                                <i class="ph-duotone  ph-projector-screen-chart f-s-20"></i>
                              </div>
                              <div class="search-list-content">
                                <a href="privacy_policy.html" target="_blank"><h6 class="mb-0 text-dark">data visualization</h6></a>
                                <p class="f-s-13 mb-0 text-secondary">#RY810</p>
                              </div>
                            </li>
                            <li class="search-list-item">
                              <div
                                      class="h-35 w-35 d-flex-center b-r-15 overflow-hidden bg-light-dark search-list-avtar">
                                <i class="ph-duotone  ph-shield-check f-s-20"></i>
                              </div>
                              <div class="search-list-content">
                                <a href="terms_condition.html" target="_blank"><h6 class="mb-0 text-dark">security protocols</h6></a>
                                <p class="f-s-13 mb-0 text-secondary">#ATR56</p>
                              </div>
                            </li>
                            <li class="search-list-item">
                              <div
                                      class="h-35 w-35 d-flex-center b-r-15 overflow-hidden bg-light-primary search-list-avtar">
                                <i class="ph-duotone  ph-app-window f-s-20"></i>
                              </div>
                              <div class="search-list-content">
                                <a href="sign_in.html" target="_blank"><h6 class="mb-0 text-dark">authentication methods</h6></a>
                                <p class="f-s-13 mb-0 text-secondary">#YE615</p>
                              </div>
                            </li>
                            <li class="search-list-item">
                              <div
                                      class="h-35 w-35 d-flex-center b-r-15 overflow-hidden bg-light-dark search-list-avtar">
                                <i class="ph-duotone  ph-table f-s-20"></i>
                              </div>
                              <div class="search-list-content">
                                <a href="data_table.html" target="_blank"><h6 class="mb-0 f-s-16 text-dark">Data Table</h6></a>
                                <p class="f-s-13 mb-0 text-secondary">#YE615</p>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </li>

                  <li class="header-dark">
                    <div class="sun-logo head-icon">
                      <i class="ph ph-moon-stars"></i>
                    </div>
                    <div class="moon-logo head-icon">
                      <i class="ph ph-sun-dim"></i>
                    </div>
                  </li>

                  <li class="header-notification">
                    <a href="#" class="d-block head-icon position-relative" role="button" data-bs-toggle="offcanvas"
                       data-bs-target="#notificationcanvasRight" aria-controls="notificationcanvasRight">
                      <i class="ph ph-bell"></i>
                      <span
                              class="position-absolute translate-middle p-1 bg-success border border-light rounded-circle animate__animated animate__fadeIn animate__infinite animate__slower"></span>
                    </a>
                    <div class="offcanvas offcanvas-end header-notification-canvas" tabindex="-1"
                         id="notificationcanvasRight" aria-labelledby="notificationcanvasRightLabel">
                      <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="notificationcanvasRightLabel">Notification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                      </div>
                      <div class="offcanvas-body app-scroll p-0">
                        <div class="head-container">
                          <div class="notification-message head-box">
                            <div class="message-images">
                              <span class="bg-secondary h-35 w-35 d-flex-center b-r-10 position-relative">
                                <img src="{{ asset('assets/images/ai_avtar/6.jpg') }}" alt="" class="img-fluid b-r-10">
                                <span
                                        class="position-absolute bottom-30 end-0 p-1 bg-secondary border border-light rounded-circle notification-avtar"></span>
                              </span>
                            </div>
                            <div class="message-content-box flex-grow-1 ps-2">

                              <a href="./read_email.html" class="f-s-15 text-secondary mb-0"><span
                                      class="f-w-500 text-secondary">Gene Hart</span> wants to edit <span
                                      class="f-w-500 text-secondary">Report.doc</span></a>
                              <div>
                                <a class="d-inline-block f-w-500 text-success me-1" href="#">Approve</a>
                                <a class="d-inline-block f-w-500 text-danger" href="#">Deny</a>
                              </div>
                              <span class="badge text-light-secondary mt-2"> sep 23 </span>

                            </div>
                            <div class="align-self-start text-end">
                              <i class="ph ph-trash f-s-18 text-danger close-btn"></i>
                            </div>
                          </div>
                          <div class="notification-message head-box">
                            <div class="message-images">
                              <span class="bg-light-dark h-35 w-35 d-flex-center b-r-10 position-relative">
                                <i class="ph-duotone  ph-truck f-s-18"></i>
                              </span>
                            </div>
                            <div class="message-content-box flex-grow-1 ps-2">
                              <a href="./read_email.html" class="f-s-15 text-secondary mb-0">Hey <span
                                      class="f-w-500 text-secondary">Emery McKenzie</span>, get ready: Your order from <span
                                      class="f-w-500 text-secondary">@Shopper.com</span> is out for delivery today!</a>
                              <span class="badge text-light-secondary mt-2"> sep 23 </span>

                            </div>
                            <div class="align-self-start text-end">
                              <i class="ph ph-trash f-s-18 text-danger close-btn"></i>
                            </div>
                          </div>
                          <div class="notification-message head-box">
                            <div class="message-images">
                              <span class="bg-secondary h-35 w-35 d-flex-center b-r-10 position-relative">
                                <img src="{{ asset('assets/images/ai_avtar/2.jpg') }}" alt="" class="img-fluid b-r-10">
                                <span
                                        class="position-absolute  end-0 p-1 bg-secondary border border-light rounded-circle notification-avtar"></span>
                              </span>
                            </div>
                            <div class="message-content-box flex-grow-1 ps-2">
                              <a href="./read_email.html" class="f-s-15 text-secondary mb-0"><span
                                      class="f-w-500 text-secondary">Simon Young</span> shared a file called <span
                                      class="f-w-500 text-secondary">Dropdown.pdf</span></a>
                              <span class="badge text-light-secondary mt-2"> 30 min</span>

                            </div>
                            <div class="align-self-start text-end">
                              <i class="ph ph-trash f-s-18 text-danger close-btn"></i>
                            </div>
                          </div>
                          <div class="notification-message head-box">
                            <div class="message-images">
                              <span class="bg-secondary h-35 w-35 d-flex-center b-r-10 position-relative">
                                <img src="{{ asset('assets/images/ai_avtar/5.jpg') }}" alt="" class="img-fluid b-r-10">
                                <span
                                        class="position-absolute end-0 p-1 bg-secondary border border-light rounded-circle notification-avtar"></span>
                              </span>
                            </div>
                            <div class="message-content-box flex-grow-1 ps-2">
                              <a href="./read_email.html" class="f-s-15 text-secondary mb-0"><span
                                      class="f-w-500 text-secondary">Becky G. Hayes</span> has added a comment to <span
                                      class="f-w-500 text-secondary">Final_Report.pdf</span></a>
                              <span class="badge text-light-secondary mt-2"> 45 min</span>
                            </div>
                            <div class="align-self-start text-end">
                              <i class="ph ph-trash f-s-18 text-danger close-btn"></i>
                            </div>
                          </div>
                          <div class="notification-message head-box">
                            <div class="message-images">
                              <span class="bg-secondary h-35 w-35 d-flex-center b-r-10 position-relative">
                                <img src="{{ asset('assets/images/ai_avtar/1.jpg') }}" alt="" class="img-fluid b-r-10">
                                <span
                                        class="position-absolute  end-0 p-1 bg-secondary border border-light rounded-circle notification-avtar"></span>
                              </span>
                            </div>
                            <div class="message-content-box flex-grow-1 ps-2">
                              <a href="./read_email.html" class="f-s-15 text-secondary mb-0"><span
                                      class="f-w-600 text-secondary">Romaine Nadeau</span> invited you to join a meeting
                              </a>
                              <div>
                                <a class="d-inline-block f-w-500 text-success me-1" href="#">Join</a>
                                <a class="d-inline-block f-w-500 text-danger" href="#">Decline</a>
                              </div>

                              <span class="badge text-light-secondary mt-2"> 1 hour ago </span>
                            </div>
                            <div class="align-self-start text-end">
                              <i class="ph ph-trash f-s-18 text-danger close-btn"></i>
                            </div>
                          </div>

                          <div class="hidden-massage py-4 px-3">
                            <img src="{{ asset('assets/images/icons/bell.png') }}" class="w-50 h-50 mb-3 mt-2" alt="">
                            <div>
                              <h6 class="mb-0">Notification Not Found</h6>
                              <p class="text-secondary">When you have any notifications added here,will
                                appear here.
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
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
                              <p class="f-s-12 mb-0 text-secondary">lauradesign@gmail.com</p>
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
  <script src="{{ asset('assets/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatable/jquery.dataTables.min.js') }}"></script> 
  <script src="{{ asset('assets/js/data_table.js') }}"></script>
  <script src="{{ asset('assets/js/script.js') }}"></script>
  <script src="{{ asset('assets/js/customizer.js') }}"></script>
  

@stack('other-scripts')
@stack('materials-scripts')
@stack('locations-scripts')
@stack('item-scripts')
@stack('devices-scripts')
@stack('companies-scripts')
  
</body>

</html>