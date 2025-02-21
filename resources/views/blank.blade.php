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
            <h4 class="main-title">Blank</h4>
            <ul class="app-line-breadcrumbs mb-3">
                <li class="">
                <a href="#" class="f-s-14 f-w-500">
                    <span>
                    <i class="ph-duotone  ph-newspaper f-s-16"></i> Other Pages
                    </span>
                </a>
                </li>
                <li class="active">
                <a href="#" class="f-s-14 f-w-500">Blank</a>
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
                <div class="col-sm-4">
                    <div class="card eshop-cards">
                        <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span class="bg-warning h-40 w-40 d-flex-center b-r-15 f-s-18">
                            <i class="ph-bold  ph-user"></i>
                            </span>
                            <div class="dropdown">
                            <a class="text-warning " href="{{route('user.index')}}">
                                User
                            </a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="flex-shrink-0 align-self-end">
                            <p class="f-s-16 mb-0">Technician</p>
                            <h5>{{$user}}</h5>
                            </div>
                            <div class="visits-chart">
                            <div id="visitsChart"></div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card eshop-cards">
                        <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span class="bg-secondary h-40 w-40 d-flex-center b-r-15 f-s-18">
                            <i class="ph-duotone  ph-map-pin-line"></i>
                            </span>
                            <div class="dropdown">
                            <a class="text-secondary " href="{{route('locations.index')}}">
                                location
                            </a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center position-relative">
                            <div class="flex-shrink-0 align-self-end">
                            <p class="f-s-16 mb-0">Location</p>
                            <h5>{{$location}}</h5>
                            </div>
                            <div class="order-chart">
                            <div id="orderChart"></div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card eshop-cards">
                        <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span class="bg-primary h-40 w-40 d-flex-center b-r-15 f-s-18">
                            <i class="ph-bold  ph-pulse"></i>
                            </span>
                            <div class="">
                            <a class="text-primary " href="{{route('devices.index')}}">
                                Device
                            </a>
                           
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="flex-shrink-0 align-self-end">
                            <p class="f-s-16 mb-0">Devices</p>

                            <h5>{{$device}}</h5>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
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
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
            <h5>Default Card</h5>
            </div>
            <div class="card-body">
            <h6>Where does it come from ?</h6>
            <p class="text-secondary"> Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard
                McClinton, a Latin professor at Hampered-Sydney College in Virginia, looked up one of the more
                obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the
                word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections
                1.10.32 and 1.10.33 of "de Minibus Bono rum et Malo rum" (The Extremes of Good and Evil) by Cicero,
                written in 45 BC. This book is a treatise on the theory of ethics, very popular during the
                Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in
                section 1.10.32 </p>
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
    

    
</script>
@endpush