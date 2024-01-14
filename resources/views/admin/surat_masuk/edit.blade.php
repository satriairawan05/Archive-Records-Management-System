@extends('admin.layout.app')

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
                <li class="breadcrumb-item"><a href="{{ route('surat_masuk.index') }}">Surat Masuk</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </div>
    </div>
@endsection

@push('css')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('vendor/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        $("#bidang").select2();

        $("#sub-bidang").select2();
    </script>
@endpush

@section('app')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('surat_masuk.update', $surat->sm_id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group row mt-3">
                            <div class="col-6">
                                <label for="sm_jenis" class="col-form-label text-dark">Jenis Surat <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="sm_jenis"
                                    placeholder="Jenis Surat" name="sm_jenis" value="{{ old('sm_jenis',$surat->sm_jenis) }}" required>
                                @error('sm_jenis')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="sm_asal" class="col-form-label text-dark">Asal Surat <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="sm_asal"
                                    placeholder="Asal Surat" name="sm_asal" value="{{ old('sm_asal',$surat->sm_asal) }}" required>
                                @error('sm_asal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            {{-- <div class="col-4">
                                <label for="sm_no_surat" class="col-form-label text-dark">Nomor Surat <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="sm_no_surat"
                                    placeholder="Nomor Surat" name="sm_no_surat" value="{{ old('sm_no_surat',$surat->sm_no_surat) }}" required>
                                @error('sm_no_surat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> --}}
                            <div class="col-6">
                                <label for="sm_perihal" class="col-form-label text-dark">Perihal Surat <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="sm_perihal"
                                    placeholder="Perihal Surat" name="sm_perihal" value="{{ old('sm_perihal',$surat->sm_perihal) }}" required>
                                @error('sm_perihal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="sm_penerima" class="col-form-label text-dark">Penerima Surat <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="sm_penerima"
                                    placeholder="Penerima Surat" name="sm_penerima" value="{{ old('sm_penerima',$surat->sm_penerima) }}" required>
                                @error('sm_penerima')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            {{-- <div class="col-6">
                                <label for="sm_tgl_surat" class="col-form-label text-dark">Tanggal Surat <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-sm" id="sm_tgl_surat"
                                    placeholder="Tanggal Surat" name="sm_tgl_surat" value="{{ old('sm_tgl_surat',$surat->sm_tgl_surat) }}" required>
                                @error('sm_tgl_surat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> --}}
                            <div class="col-12">
                                <label for="sm_tgl_diterima" class="col-form-label text-dark">Tanggal Diterima Surat <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-sm" id="sm_tgl_diterima"
                                    placeholder="Tanggal diterima" name="sm_tgl_diterima" value="{{ old('sm_tgl_diterima',$surat->sm_tgl_diterima) }}" required>
                                @error('sm_tgl_diterima')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-6">
                                <label for="bid_id" class="col-form-label text-dark">Bidang <span
                                        class="text-danger">*</span> </label>
                                <select id="bidang" name="bid_id" class="form-control form-control-sm">
                                    @foreach ($bidang as $b)
                                        @if (old('bid_id') == $b->bid_id)
                                            <option value="{{ $b->bid_id }}" selected>{{ $b->bid_name }}</option>
                                        @else
                                            <option value="{{ $b->bid_id }}">{{ $b->bid_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="sub_id" class="col-form-label text-dark">Sub Bidang <span
                                        class="text-danger">*</span> </label>
                                <select id="sub-bidang" name="sub_id" class="form-control form-control-sm">
                                    @foreach ($sub as $s)
                                        @if (old('sub_id') == $s->sub_id)
                                            <option value="{{ $s->sub_id }}" selected>{{ $s->sub_name }}</option>
                                        @else
                                            <option value="{{ $s->sub_id }}">{{ $s->sub_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-12">
                                <label for="sm_file" class="col-form-label text-dark">File Surat <span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control-file" id="sm_file" name="sm_file" required>
                                @error('sm_file')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-12 d-flex justify-content-center">
                                <a href="{{ route('surat_masuk.index') }}" class="btn btn-sm btn-info mx-2"><i
                                        class="fa fa-reply-all"></i></a>
                                <button type="submit" class="btn btn-sm btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
