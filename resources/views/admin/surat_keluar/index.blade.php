@extends('admin.layout.app')

@php
    $read = 0;
    $approval = 0;
    $update = 0;
    $delete = 0;

    foreach ($pages as $r) {
        if ($r->page_name == $name) {
            if ($r->action == 'Read') {
                $read = $r->access;
            }

            if ($r->action == 'Approval') {
                $approval = $r->access;
            }

            if ($r->action == 'Update') {
                $update = $r->access;
            }

            if ($r->action == 'Delete') {
                $delete = $r->access;
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
        $('#myTable').DataTable({
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
                <li class="breadcrumb-item active">Surat Keluar</li>
            </ol>
        </div>
    </div>
@endsection

@section('app')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if($read == 1)

                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
