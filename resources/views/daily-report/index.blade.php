@extends('layouts.app')
@section('title')
Daily Report
@endsection
@section('content')


<main>
    <div class="container-fluid">
    <!-- Breadcrumb start -->
    <div class="row m-1">
        <div class="col-12 ">
            <h4 class="main-title">Daily Report</h4>
            <ul class="app-line-breadcrumbs mb-3">
                <li class="">
                <a href="{{ route('dashboard') }}" class="f-s-14 f-w-500"> 
                    <span>
                    <i class="ph-duotone  ph-table f-s-16"></i> Home
                    </span>
                </a>
                </li>
                <li class="active">
                <a href="#" class="f-s-14 f-w-500">Index</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb end -->

    <div class="row">
        <div class="col-12">
        <div class="card ">
            <div class="card-header">
            <h5></h5>
            <p>All data about adaily report from Sagadasa Optima Solusi </p>
            </div>
            <div class="card-body p-0">
            <div class="app-datatable-default overflow-auto">
                <table id="example" class="display app-data-table default-data-table">
                <thead>
                    <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>Tiger Nixon</td>
                    <td><span class="badge text-light-primary">System Architect</span></td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>$3674.55</td>
                    <td>$320,800</td>
                    <td>
                        <button type="button" class="btn btn-light-success icon-btn b-r-4">
                        <i class="ti ti-edit text-success"></i> 
                        </button>
                        <button type="button" class="btn btn-light-danger icon-btn b-r-4 delete-btn">
                        <i class="ti ti-trash"></i>
                        </button>
                    </td>
                    </tr>
                    <tr>
                    <td>Garrett Winters</td>
                    <td><span class="badge text-light-success">Accountant</span></td>
                    <td>Tokyo</td>
                    <td>63</td>
                    <td>2011-07-25</td>
                    <td>$170,750</td>
                    <td>
                        <button type="button" class="btn btn-light-success icon-btn b-r-4">
                        <i class="ti ti-edit text-success"></i> 
                        </button>
                        <button type="button" class="btn btn-light-danger icon-btn b-r-4 delete-btn">
                        <i class="ti ti-trash"></i>
                        </button>
                    </td>
                    </tr>
                </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>      
    </div>
    </div>
</main>

@endsection