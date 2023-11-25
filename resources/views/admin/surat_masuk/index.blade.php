@extends('admin.layout.app')

@php
    $read = 0;
    $update = 0;
    $delete = 0;

    foreach ($pages as $r) {
        if ($r->page_name == $name) {
            if ($r->action == 'Read') {
                $read = $r->access;
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
                <li class="breadcrumb-item active">Surat Masuk</li>
            </ol>
        </div>
    </div>
@endsection

@section('app')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if ($read == 1)
                        <div class="card-body">
                            <table class="table" id="myTable">
                                <thead class="thead-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>No Surat</th>
                                        <th>Tanggal Surat</th>
                                        <th>Penerima</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($surat as $s)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $s->sm_no_surat }}</td>
                                            <td>{{ $s->sm_tgl_surat }}</td>
                                            <td>{{ $s->sm_penerima }}</td>
                                            <td>
                                                @if ($update == 1)
                                                    <a href="{{ route('surat_masuk.edit', $s->sm_id) }}"
                                                        class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                                @endif
                                                @if ($delete == 1)
                                                    <form action="{{ route('surat_masuk.destroy', $s->sm_id) }}"
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
    </div>
@endsection
