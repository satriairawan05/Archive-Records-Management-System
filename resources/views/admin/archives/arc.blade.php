@extends('admin.layout.app')

@php
    $read = 0;

    foreach ($pages as $r) {
        if ($r->page_name == $name) {
            if ($r->action == 'Read') {
                $read = $r->access;
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

        const print = (id) => {
            var contents = "";
            var url = "{{ route('surat_keluar.print', ':id') }}";
            url = url.replace(':id', id);
            $.get(url, function(data, status) {
                contents = data;
                var frame1 = $('<iframe />');
                frame1[0].name = "frame1";
                frame1.css({
                    "position": "absolute",
                    "top": "-1000000px"
                });
                $("body").append(frame1);
                var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument
                    .document ?
                    frame1[0].contentDocument.document : frame1[0].contentDocument;
                frameDoc.document.open();
                frameDoc.document.write(`
            <!DOCTYPE html>
            <html lang="en">

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>{{ env('APP_NAME') }}</title>
                    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
                    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
                    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
                    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.ico') }}">
                </head>

                <body id='bodycontent'>`);
                frameDoc.document.write(contents);
                frameDoc.document.write(`
                </body>
            </html>`);
                frameDoc.document.close();
                setTimeout(function() {
                    window.frames["frame1"].focus();
                    window.frames["frame1"].print();
                    frame1.remove();
                }, 1000);
            });
        }
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
                <li class="breadcrumb-item"><a href="{{ route('archives') }}">Archive</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('archives') }}?bidang_id={{ $bidang->bid_id }}">{{ $bidang->bid_name }}</a></li>
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
                        <table class="table" id="myTable">
                            <thead class="thead-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Perihal</th>
                                    <th>Nomor Surat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($surat as $s)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $s->sk_perihal }}</td>
                                        <td>{{ $s->sk_no }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-secondary" target="__blank"
                                                href="{{ route('surat_keluar.print', $s->sk_id) }}"><i
                                                    class="fa fa-print"></i></a>
                                            @if($s->sk_file != null)
                                            <a class="btn btn-sm btn-light" target="__blank"
                                                href="{{ route('surat_keluar.download', $s->sk_id) }}"><i
                                                    class="fa fa-download"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
