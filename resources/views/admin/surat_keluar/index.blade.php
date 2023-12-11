@extends('admin.layout.app')

@php
    $read = 0;
    $approval = 0;
    $update = 0;
    $delete = 0;
    $closing = 0;

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

            if ($r->action == 'Close') {
                $closing = $r->access;
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
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery/jquery.js') }}"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('vendor/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sk_deskripsi').select2({
                dropdownParent: $('#modal')
            });
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
                @if ($read == 1)
                    <div class="card-body">
                        <table class="table" id="myTable">
                            <thead class="thead-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Nomor Surat</th>
                                    <th>Asal</th>
                                    <th>Tujuan</th>
                                    <th>Perihal</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($surat as $s)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $s->sk_no_old == $s->sk_no ? $s->sk_no_old : $s->sk_no }}</td>
                                        <td>{{ $s->sk_asal }}</td>
                                        <td>{{ $s->sk_tujuan }}</td>
                                        <td>{{ $s->sk_perihal }}</td>
                                        <td>{{ \Carbon\Carbon::parse($s->sk_tgl)->isoFormat('DD MMMM YYYY') }}</td>
                                        <td>
                                            @if (
                                                $approval == 1 &&
                                                    \App\Models\Approval::where('sk_id', $s->sk_id)->where('user_id', auth()->user()->id)->where('app_ordinal', (int) $s->skstep)->first())
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                    data-target=".bd-example-modal-lg"><i
                                                        class="fa fa-bookmark"></i></button>

                                                <div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1"
                                                    role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Surat Cuti
                                                                    {{ $s->pic_name }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('surat_keluar.approval', $s->sk_id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('put')
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-2">
                                                                            <label for="sc_disposisi">Disposisi <span
                                                                                    class="text-danger">*</span></label>
                                                                        </div>
                                                                        @php
                                                                            $disposisi = [['name' => 'Accepted'], ['name' => 'Rejected']];
                                                                        @endphp
                                                                        <div class="col-10">
                                                                            <select class="form-select form-select-sm"
                                                                                id="sk_disposisi" name="sk_disposisi">
                                                                                @foreach ($disposisi as $d)
                                                                                    @if (old('sk_disposisi') == $d['name'])
                                                                                        <option name="sk_disposisi"
                                                                                            value="{{ $d['name'] }}"
                                                                                            selected>
                                                                                            {!! $d['name'] !!}</option>
                                                                                    @else
                                                                                        <option name="sk_disposisi"
                                                                                            value="{{ $d['name'] }}">
                                                                                            {!! $d['name'] !!}
                                                                                        </option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-3">
                                                                        <div class="col-2">
                                                                            <label for="sk_remark">Remark <span
                                                                                    class="text-danger">*</span></label>
                                                                        </div>
                                                                        <div class="col-10">
                                                                            <input type="text" name="sk_remark"
                                                                                id="sk_remark"
                                                                                class="form-control form-control-sm"
                                                                                value="{{ old('sk_remark') }}"
                                                                                placeholder="Ex: Okeee">
                                                                        </div>
                                                                    </div>
                                                                    @if ($closing == 1)
                                                                        <div class="row mt-3">
                                                                            <div class="col-2">
                                                                                <label for="sk_status">Closing <span
                                                                                        class="text-danger">*</span></label>
                                                                            </div>
                                                                            <div class="col-10">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" value="{{ old('sk_status') }}"
                                                                                    id="sk_status">
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save
                                                                        changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <a href="{{ route('surat_keluar.print', $s->sk_id) }}"
                                                class="btn btn-sm btn-secondary" target="__blank"><i
                                                    class="fa fa-print"></i></a>
                                            @if ($update == 1)
                                                <a href="{{ route('surat_keluar.edit', $s->sk_id) }}"
                                                    class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if ($delete == 1)
                                                <form action="{{ route('surat_keluar.destroy', $s->sk_id) }}"
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
