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
        $('#myTable').DataTable({
            createdRow: function(row, data, index) {
                $(row).addClass('selected')
            }
        });

        $('#myTable2').DataTable({
            createdRow: function(row, data, index) {
                $(row).addClass('selected')
            }
        });

        $('#myTable3').DataTable({
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
                @if ($createCompany == 1)
                    <div class="card-header d-flex justify-content-end">
                        <a href="{{ route('perusahaan.create') }}" class="btn btn-sm btn-success"><i
                                class="fa fa-plus"></i></a>
                    </div>
                @endif
                @if ($readCompany == 1)
                    <div class="card-body">
                        <table class="table" id="myTable">
                            <thead class="thead-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>No HP</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $c)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $c->com_name }}</td>
                                        <td>{{ $c->com_address }}</td>
                                        <td>{{ $c->com_no_hp }}</td>
                                        <td>
                                            @if ($updateCompany == 1)
                                                <a href="{{ route('perusahaan.edit', $c->com_id) }}"
                                                    class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if ($deleteCompany == 1)
                                                <form action="{{ route('perusahaan.destroy', $c->com_id) }}"
                                                    method="post" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-sm btn-danger"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <div class="card">
                @if ($createBid == 1)
                    <div class="card-header d-flex justify-content-end">
                        <a href="{{ route('bidang.create') }}" class="btn btn-sm btn-success"><i
                                class="fa fa-plus"></i></a>
                    </div>
                @endif
                @if ($readBid == 1)
                    <div class="card-body">
                        <table class="table" id="myTable2">
                            <thead class="thead-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Alias</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bidang as $b)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $b->bid_name }}</td>
                                        <td>{{ $b->bid_alias }}</td>
                                        <td>
                                            @if ($updateBid == 1)
                                                <a href="{{ route('bidang.edit', $b->bid_id) }}"
                                                    class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if ($deleteBid == 1)
                                                <form action="{{ route('bidang.destroy', $b->bid_id) }}"
                                                    method="post" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-sm btn-danger"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <div class="card">
                @if ($createSub == 1)
                    <div class="card-header d-flex justify-content-end">
                        <a href="{{ route('sub_bidang.create') }}" class="btn btn-sm btn-success"><i
                                class="fa fa-plus"></i></a>
                    </div>
                @endif
                @if ($readSub == 1)
                    <div class="card-body">
                        <table class="table" id="myTable3">
                            <thead class="thead-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Alias</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subBidang as $b)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $b->sub_name }}</td>
                                        <td>{{ $b->sub_alias }}</td>
                                        <td>
                                            @if ($updateSub == 1)
                                                <a href="{{ route('sub_bidang.edit', $b->sub_id) }}"
                                                    class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if ($deleteSub == 1)
                                                <form action="{{ route('sub_bidang.destroy', $b->sub_id) }}"
                                                    method="post" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-sm btn-danger"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
