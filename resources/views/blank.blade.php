@extends('layouts.app')
@section('title')
Dashboard
@endsection

@section('content')


<main onload="">
    <div class="container-fluid">
    <!-- Breadcrumb start -->
    <div class="row m-1">
        <div class="col-12 ">
            <h4 class="main-title">@yield('title')</h4>
            <ul class="app-line-breadcrumbs mb-3">
                <li class="">
                <a href="#" class="f-s-14 f-w-500">
                    <span>
                    <i class="ph-duotone  ph-newspaper f-s-16"></i> Other Pages
                    </span>
                </a>
                </li>
                <li class="active">
                <a href="#" class="f-s-14 f-w-500">@yield('title')</a>
                </li>
            </ul>
        </div>
    </div>
            <!-- Breadcrumb end -->
    <div class="row widget-container">
    <div class="col-md-12 col-lg-12 col-xxl-4 order--2-lg">
                <div class="row">
                  <div class="col-3">
                    <div class="card courses-cards card-success">
                      <div class="card-body">
                        <i class="ph-duotone  ph-user icon-bg"></i>
                        <span class="bg-white h-50 w-50 d-flex-center b-r-15">
                          <i class="ph-duotone  ph-user text-success f-s-24"></i>
                        </span>
                        <div class="mt-5">
                          <h4>{{$user}}</h4>
                          <a class="" href="{{route('user.index')}}">
                                
                              <p class="f-w-500 mb-0">Technician Stanby</p>
                            </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="card courses-cards card-info">
                      <div class="card-body">
                        <i class="ph-duotone  ph-map-pin-line icon-bg"></i>
                        <span class="bg-white h-50 w-50 d-flex-center b-r-15">
                          <i class="ph-duotone  ph-map-pin-line text-info f-s-24"></i>
                        </span>
                        <div class="mt-5">
                          <h4>{{$location}}</h4>
                          <p class="f-w-500 mb-0">Location discovered</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="card courses-cards card-primary">
                      <div class="card-body">
                        <i class="ph-duotone  ph-gear icon-bg"></i>
                        <span class="bg-white h-50 w-50 d-flex-center b-r-15">
                          <i class="ph-duotone  ph-gear text-primary f-s-24"></i>
                        </span>
                        <div class="mt-5">
                          <h4>{{$device}}</h4>
                          <p class="f-w-500 mb-0">All Device Covered</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="card courses-cards card-warning">
                      <div class="card-body">
                        <i class="ph-duotone  ph-chart-line icon-bg"></i>
                        <span class="bg-white h-50 w-50 d-flex-center b-r-15">
                          <i class="ph-duotone  ph-chart-line text-warning text-warning f-s-24"></i>
                        </span>
                        <div class="mt-5">
                          <h4>{{$rowReport}}</h4>
                          <p class="f-w-500 mb-0">Activities Done</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        <!-- Ecommerce card start -->
        <div class="col-lg-12 col-xxl-4">
            <div class="row">
                @foreach($company as $row)
                <div class="col-sm-5">
                    <div class="card eshop-cards">
                        <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="h-60 w-60 d-flex-center b-r-10 overflow-hidden me-2 text-bg-light simple-table-avtar">
                                <a href="{{asset('assets/images/logo/'.$row->logo)}}" class="glightbox" data-glightbox="type: image; zoomable: true;" target="blank"><img src="{{asset('assets/images/logo/'.$row->logo)}}" alt="" class="img-fluid"></a>
                            </div>
                            
                            <div class="dropdown">
                            <a class="text-secondary " href="{{route('companies.index')}}">
                            <i class="ph-duotone  ph-map-pin-line"></i> {{ $row->address }}
                            </a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="flex-shrink-0 align-self-end">
                          
                                <h5>{{$row->company_name}}</h5>
                                <p class="f-s-16 mb-0"> {{ $row->contact }}</p>
                            </div>
                            <div class="visits-chart">
                            <div id="visitsChart"></div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-sm-2 col-4 m-auto">
                    <div class="card eshop-cards card-dark">
                        <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="flex-shrink-0 align-self-end">
                                <div class="digital-clock text-light">00:00:00</div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                @foreach($contractor as $rows)
                <div class="col-sm-5">
                    <div class="card eshop-cards">
                        <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="h-60 w-60 d-flex-center b-r-10 overflow-hidden me-2 text-bg-light simple-table-avtar">
                                <a href="{{asset('assets/images/logo/'.$rows->logo)}}" class="glightbox" data-glightbox="type: image; zoomable: true;" target="blank"><img src="{{asset('assets/images/logo/'.$rows->logo)}}" alt="" class="img-fluid"></a>
                            </div>
                            <div class="dropdown">
                            <a class="text-secondary " href="{{route('master-contractors.index')}}">
                                {{ $rows->address }}
                            </a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center position-relative">
                            <div class="flex-shrink-0 align-self-end">
                                <h5>{{$rows->contractor_name}}</h5>
                                <p class="f-s-16 mb-0">{{$rows->contact_information}}</p>
                            </div>
                            <div class="order-chart">
                            <div id="orderChart"></div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- Ecommerce card end -->
    </div>
    <!-- Blank start -->
    <div class="row">
        <!-- Default Card start -->
         
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                <h5>Activity</h5>
                </div>
                <div class="card-body">
                <div id="activityLine"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                <h5>Status Maintenance Item</h5>
                </div>
                <div class="card-body">
                <div id="LogMaintenance"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
            <h5>About Me</h5>
            </div>
            <div class="card-body">
            <h6>Where does it come from ?</h6>
            <p class="text-secondary"> </p>
            </div>
            <div class="card-footer">
            <p class="float-start text-secondary p-t-10 mb-0">1 days Ago</p>

            <a href="#" class="float-end fw-bold"> Read More  </a>
            </div>

        </div>
        </div>

        <!-- Default Card end -->
    </div>
    <!-- Blank end -->
    </div>
</main>

@endsection
@push('item-scripts')
<script>
    // var data1 = {{ $data[0] ?? 0 }};
    // var data2 = {{ $data[1] ?? 0 }};
    // var data3 = {{ $data[2] ?? 0 }};

    // var month1 = "{{ $dbMonth[0] ?? '' }}";
    // var month2 = "{{ $dbMonth[1] ?? '' }}";
    // var month3 = "{{ $dbMonth[2] ?? '' }}";
    var dataSeries = JSON.parse('{!! json_encode($data) !!}');
    var categories = JSON.parse('{!! json_encode($dbMonth) !!}');
    var locationNames = JSON.parse('{!! json_encode($deviceName) !!}');
    var totalOk = JSON.parse('{!! json_encode($totalOk) !!}');
    var totalError = JSON.parse('{!! json_encode($totalError) !!}');
    

    newChart(dataSeries,categories);
    widgetActivityChart(dataSeries);
    newChart2(totalOk,totalError,locationNames);

    
    loginNotification('{!! json_encode($sesUser) !!}');
    
    $(document).ready(function() {
        clockUpdate();
        setInterval(clockUpdate, 1000);
        })

        function clockUpdate() {
        var date = new Date();
        $('.digital-clock');
        function addZero(x) {
            if (x < 10) {
            return x = '0' + x;
            } else {
            return x;
            }
        }

        function twelveHour(x) {
            if (x > 12) {
            return x = x - 12;
            } else if (x == 0) {
            return x = 12;
            } else {
            return x;
            }
        }

        var h = addZero(twelveHour(date.getHours()));
        var m = addZero(date.getMinutes());
        var s = addZero(date.getSeconds());

        $('.digital-clock').text(h + ':' + m + ':' + s)
        }
    
</script>
@endpush