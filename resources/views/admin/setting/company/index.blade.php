@extends('admin.layout.app')

@php
    $createCompany = 0;
    $readCompany = 0;
    $updateCompany = 0;
    $deleteCompany = 0;
    $createBid = 0;
    $readBid = 0;
    $updateBid = 0;
    $deleteBid = 0;
    $createSub = 0;
    $readSub = 0;
    $updateSub = 0;
    $deleteSub = 0;

    foreach ($pages as $r) {
        if ($r->page_name == $name) {
            if ($r->action == 'Create') {
                $createCompany = $r->access;
            }

            if ($r->action == 'Read') {
                $readCompany = $r->access;
            }

            if ($r->action == 'Update') {
                $updateCompany = $r->access;
            }

            if ($r->action == 'Delete') {
                $deleteCompany = $r->access;
            }
        }
    }

    foreach ($page_bids as $r) {
        if ($r->page_name == 'Bidang') {
            if ($r->action == 'Create') {
                $createBid = $r->access;
            }

            if ($r->action == 'Read') {
                $readBid = $r->access;
            }

            if ($r->action == 'Update') {
                $updateBid = $r->access;
            }

            if ($r->action == 'Delete') {
                $deleteBid = $r->access;
            }
        }
    }

    foreach ($page_subs as $r) {
        if ($r->page_name == 'Sub Bidang') {
            if ($r->action == 'Create') {
                $createSub = $r->access;
            }

            if ($r->action == 'Read') {
                $readSub = $r->access;
            }

            if ($r->action == 'Update') {
                $updateSub = $r->access;
            }

            if ($r->action == 'Delete') {
                $deleteSub = $r->access;
            }
        }
    }
@endphp

@push('css')
    <!-- Datatable -->
    <style>
        .thead-primary {
            color: var(--dishub-color) !important;
        }
    </style>
    <link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endpush

@push('js')
    <!-- Datatable -->
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript">
        let table = $('#myTable').DataTable({
            createdRow: function(row, data, index) {
                $(row).addClass('selected')
            }
        });
    </script>
@endpush

@section('breadcrumb')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0 justify-content-sm-start">
            <div class="welcome-text">
                <h4>{{ $name }}</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item active">Perusahaan</li>
            </ol>
        </div>
    </div>
@endsection

@section('app')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                </div>
                <div class="card-body">

                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-end">
                </div>
                <div class="card-body">

                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-end">
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
@endsection
