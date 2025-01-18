@extends('layouts.app')

@section('content')


<main>
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

    <!-- Blank start -->
    <div class="row">
        <div class="col-md-12">
        <div class="container mt-5">
    <table class="table table-bordered" rules="all">
        <thead>
            <tr></tr>
            <tr>
                <th colspan="4" class="text-center">RDMP JO - BALIKPAPAN</th>
            </tr>
            <tr>
                <th rowspan="2" class="text-center">logo left</th>
                <th colspan="2" class="text-center">Document Title</th>
                <th rowspan="2" class="text-center">logo right</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center"></td>
                <td class="text-center">reff</td>
                <td class="text-center">page</td>
                <td class="text-center"></td>
            </tr>
            <tr></tr>
        </tbody>
    </table>


    <h5 class="text-center text-decoration-underline mt-4">DAILY REPORT</h5>
    <div class="row mt-4">
        <div class="col-md-3 mx-auto text-start">
            <p><strong>Company:</strong> RDMPJO - BALIKPAPAN</p>
            <p><strong>Contractor:</strong> CV. SAGADASA OPTIMA SOLUSI</p>
            <p><strong>Contract Ref.:</strong></p>
            <p><strong>Location:</strong> Gate Access</p>
            <p><strong>Detail Activity:</strong> Maintenance</p>
            <p><strong>Date:</strong> 07 November 2024</p>
        </div>
    </div>

    <div class="container mt-4">
        <table class="table table-bordered">
            <tr>
                <td colspan="2"><strong>Actual work / service data :</strong></td>
            </tr>
            <tr>
                <td colspan="2" style="height: 150px;"></td>
            </tr>
            <tr>
                <td colspan="2"><strong>Conformity to P.O. :</strong> 
                    <span class="ms-3">Yes <input type="checkbox" class="form-check-input ms-2"></span> 
                    <span class="ms-3">No  <input type="checkbox" class="form-check-input ms-2"></span>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>CV. SAGADASA OPTIMA SOLUSI</strong>
                    <div class="mt-2">Representative</div>
                    <div>Sign :</div>
                    <div class="mt-3">Name :</div>
                    <div class="mt-2">Date :</div>
                </td>
                <td>
                    <strong>RDMP JO BALIKPAPAN</strong>
                    <div class="mt-2">Representative</div>
                    <div>Sign :</div>
                    <div class="mt-3">Name : _________________________</div>
                    <div class="mt-2">Date : _________________________</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="container mt-4">
        <h5>Attachment</h5>
        <h6>Detail Activity</h6>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 50%;">Photo</th>
                    <th style="width: 50%;">Activity</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <img src="your-photo-url.jpg" alt="Technician Photo" class="photo">
                    </td>
                    <td>
                        Technician standby on Gate Helipad
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="invoice-footer float-end mb-3">
                  <button type="button" class="btn btn-primary m-1" onclick="window.print()"><i
                      class="ti ti-printer"></i> Print</button>
                  <button type="button" class="btn btn-secondary m-1"><i class="ti ti-send"></i> Send Invoice</button>
                  <button type="button" class="btn btn-success m-1"><i class="ti ti-download"></i> Download</button>
                </div>




        </div>
</main>

@endsection