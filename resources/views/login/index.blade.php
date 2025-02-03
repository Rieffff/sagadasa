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
  <div class="app-wrapper d-block">
    <div class="">
      <!-- Body main section starts -->
      <main class="w-100 p-0">
        <!-- Login to your Account start -->
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 p-0">
                    <div class="login-form-container">
                      <div class="mb-4">
                       
                      </div>
                      <div class="form_container">
                        
                        <form class="app-form" method="POST" action="{{ route('login') }}">            
                        @csrf

                          <div class="mb-3 text-center">
                            <a class="logo d-inline-block" href="index.html">
                            <img src="{{ asset('assets/images/logo/sagadasa.png') }}" width="100" alt="#">
                            </a>
                            <h3>Login</h3>
                            <p class="f-s-12 text-secondary"></p>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email" id="email">
                            <div class="form-text text">We'll never share your email with anyone else.</div>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                          </div>
                          <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="formCheck1">
                            <label class="form-check-label" for="formCheck1">remember me</label>
                          </div>
                          <div>
                            <input type="submit" name="submit" class="btn btn-primary w-100" value="Login">
                          </div>
                          <div class="text-center">
                            <a href="#" class="text-secondary text-decoration-underline">Terms of use &amp; Conditions</a>
                          </div>
                        </form>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login to your Account end -->
      </main>
      <!-- Body main section ends -->
    </div>
  </div>
  <!-- latest jquery-->
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
 <!-- Toatify js-->
 <script src="{{ asset('assets/vendor/notifications/toastify-js.js') }}"></script>
 <!-- sweetalert js-->
 <script src="{{ asset('assets/vendor/sweetalert/sweetalert.js') }}"></script>
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

   function pesan(judul,pesan,ikon){

     return Swal.fire({ title: judul,text: pesan ,icon: ikon});
   }
 </script>
 

 
</body>

</html>