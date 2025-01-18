<!-- Menu Navigation starts -->
<nav>
      <div class="app-logo">
        <a class="logo d-inline-block" href="{{ route('dashboard') }}">
          <img src="{{ asset('assets/images/logo/1.png') }}" alt="#">
        </a>

        <span class="bg-light-primary toggle-semi-nav">
          <i class="ti ti-chevrons-right f-s-20"></i>
        </span>
      </div>
      <div class="app-nav" id="app-simple-bar">
        <ul class="main-nav p-0 mt-2">
          <li class="menu-title">
            <span>Dashboard</span>
          </li>
          <li>
            <a class="" data-bs-toggle="collapse" href="#dashboard" aria-expanded="false">
              <i class="ph-duotone  ph-house-line"></i>Master
            </a>
            <ul class="collapse" id="dashboard">
              <li><a href="{{ route('daily-activity.index') }}">Daily Activity</a></li>
              <li><a href="{{ route('daily-report.index') }}">Daily Report</a></li>
            </ul>
          </li>
          <li>
            <a class="" data-bs-toggle="collapse" href="#dashboard" aria-expanded="false">
              <i class="ph-duotone  ph-house-line"></i>Activity
            </a>
            <ul class="collapse" id="dashboard">
              <li><a href="{{ route('daily-activity.index') }}">Daily Activity</a></li>
              <li><a href="{{ route('daily-report.index') }}">Daily Report</a></li>
            </ul>
          </li>
          
          <li class="no-sub">
            <a class="" href="{{ route('report.index') }}">
              <i class="ph-duotone  ph-squares-four"></i> Widgets
            </a>
          </li>

         

        </ul>
      </div>

      <div class="menu-navs">
        <span class="menu-previous"><i class="ti ti-chevron-left"></i></span>
        <span class="menu-next"><i class="ti ti-chevron-right"></i></span>
      </div>

    </nav>
    <!-- Menu Navigation ends -->