<!-- Menu Navigation starts -->
<nav>
      <div class="app-logo">
        <a class="logo d-inline-block" href="{{ route('dashboard') }}">
          <img src="{{ asset('assets/images/logo/sagadasa2.png') }}" alt="#">
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
          @can('view master data')
          <li>
            <a class="" data-bs-toggle="collapse" href="#dashboard" aria-expanded="false">
              <i class="ph-duotone  ph-hard-drives"></i>Master
            </a>
            <ul class="collapse" id="dashboard">
              <li><a href="{{ route('companies.index') }}">Company</a></li>
              <li><a href="{{ route('master-contractors.index') }}">Contractors</a></li>
              <li><a href="{{ route('locations.index') }}">Location</a></li>
              <li><a href="{{ route('devices.index') }}">Devices</a></li> 
              <li><a href="{{ route('maintenance_items.index') }}">Maintenance Item</a></li>
            </ul>
          </li>
          @endcan
          <li>
            <a class="" data-bs-toggle="collapse" href="#dashboard2" aria-expanded="false">
              <i class="ph-duotone  ph-squares-four"></i>Activity
            </a>
            <ul class="collapse" id="dashboard2">
              <li><a href="{{ route('daily-activity.index') }}">Daily Activity</a></li>
              <li><a href="{{ route('daily-report.index') }}">Daily Report Ajax</a></li>
              <li><a href="{{ route('daily_reports.index') }}">Daily Report simple</a></li>
            </ul>
          </li>
          
          @can('manage users')
          <li class="no-sub" href="#user">
            <a class=""  href="{{ route('user.index') }}">
              <i class="ph-duotone  ph-user"></i> User
            </a>
          </li>
          @endcan
          <li class="no-sub">
            <a class="" href="{{ route('report.index') }}">
              <i class="ph-duotone  ph-files"></i> Report
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