@extends('admin.layout.app')

@php
    $create = 0;
    $read = 0;
    $update = 0;
    $delete = 0;

    foreach ($pages as $r) {
        if ($r->page_name == $name) {
            if ($r->action == 'Create') {
                $create = $r->access;
            }
        }
        if ($r->page_name == $name) {
            if ($r->action == 'Read') {
                $read = $r->access;
            }
        }
        if ($r->page_name == $name) {
            if ($r->action == 'Update') {
                $update = $r->access;
            }
        }
        if ($r->page_name == $name) {
            if ($r->action == 'Delete') {
                $delete = $r->access;
            }
        }
    }
@endphp

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
    <!-- Datatable -->
    <style>
        .thead-primary {
            color: var(--dishub-color) !important;
        }
    </style>
    <link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('vendor/select2/js/select2.full.min.js') }}"></script>
    {{-- <script type="text/javascript">
        $("#user_add").select2();
        $("#user_edit").select2();
        $("#sk_add").select2();
        $("#sk_edit").select2();
    </script> --}}
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
                <li class="breadcrumb-item"><a href="{{ route('approval.index') }}">Archive</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('approval.index') }}?bidang_id={{ $bidang->bid_id }}">{{ $bidang->bid_name }}</a>
                </li>
                <li class="breadcrumb-item active">{{ $sub->sub_name }}</li>
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
                        <table class="table">
                            <thead class="thead-primary">
                                <tr>
                                    <th>No</th>
                                    <th>User</th>
                                    <th>Surat Keluar</th>
                                    <th>Approval Ke</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($update == 1)
                                    @foreach ($approval as $app)
                                        <form action="{{ route('approval.update', $app->app_id) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="bid_id" value="{{ $bidang->bid_id }}">
                                            <input type="hidden" name="sub_id" value="{{ $sub->sub_id }}">
                                            <tr>
                                                <td>{{ $app->app_ordinal }}</td>
                                                <td>
                                                    <select id="user_edit" name="user_id"
                                                        class="form-control form-control-sm">
                                                        @foreach ($user as $u)
                                                            @if (old('user_id', $app->user_id) == $u->id)
                                                                <option value="{{ $u->id }}" selected>
                                                                    {{ $u->name }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $u->id }}">{{ $u->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="sk_edit" name="sk_id"
                                                        class="form-control form-control-sm">
                                                        @foreach ($surat as $s)
                                                            @if (old('sk_id', $app->sk_id) == $s->sk_id)
                                                                <option value="{{ $s->sk_id }}" selected>
                                                                    {{ $s->sk_perihal }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $s->sk_id }}">{{ $s->sk_perihal }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input class="form-control form-control-sm" type="number"
                                                        name="app_ordinal" id="app_ordinal" min="1" step="1"
                                                        max="4" placeholder="Masukan Urutan Ordinal"
                                                        value="{{ old('app_ordinal', $app->app_ordinal) }}">
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn btn-sm btn-success"><i
                                                            class="fa fa-save"></i></button>
                                                    @if ($delete == 1)
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            data-toggle="modal"
                                                            data-target="#deleteData{{ $app->app_id }}"><i
                                                                class="fa fa-trash"></i></button>
                                                    @endif
                                                </td>
                                            </tr>
                                        </form>

                                        @if ($delete == 1)
                                            <div class="modal fade" id="deleteData{{ $app->app_id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="deleteDataLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteDataLabel">Delete Approval</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h3 class="fs-5 font-weight-bold">Are You Sure?</h3>
                                                        </div>
                                                        <form action="{{ route('approval.destroy', $app->app_id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">Delete</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                @if ($create == 1)
                                    <form action="{{ route('approval.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="bid_id" value="{{ $bidang->bid_id }}">
                                        <input type="hidden" name="sub_id" value="{{ $sub->sub_id }}">
                                        <tr>
                                            <td>New Data</td>
                                            <td>
                                                <select id="user_add" name="user_id" class="form-control form-control-sm">
                                                    @foreach ($user as $u)
                                                        @if (old('user_id') == $u->id)
                                                            <option value="{{ $u->id }}" selected>
                                                                {{ $u->name }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $u->id }}">{{ $u->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select id="sk_add" name="sk_id"
                                                    class="form-control form-control-sm">
                                                    @foreach ($surat as $s)
                                                        @if (old('sk_id') == $s->sk_id)
                                                            <option value="{{ $s->sk_id }}" selected>
                                                                {{ $s->sk_created }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $s->sk_id }}">{{ $s->sk_created }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input class="form-control form-control-sm" type="number"
                                                    name="app_ordinal" id="app_ordinal" min="1" step="1"
                                                    max="4" placeholder="Masukan Urutan Ordinal"
                                                    value="{{ old('app_ordinal') }}">
                                            </td>
                                            <td>
                                                <button type="submit" id="btnSubmit" onclick="saveData()"
                                                    class="btn btn-sm btn-success"><i class="fa fa-save"></i></button>
                                            </td>
                                        </tr>
                                    </form>
                                @endif
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
