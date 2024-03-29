@extends('admin.layout.app')

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
        const checkFile = document.getElementById('checkFile');
        const fileView = document.getElementById('fileData');

        checkFile.addEventListener('change', function() {
            if (this.checked) {
                fileView.classList.remove('d-none');
            } else {
                fileView.classList.add('d-none');
            }
        });

        $("#jenis_surat").select2();

        $("#bidang").select2();

        $("#sub-bidang").select2();

        $("#company").select2();
    </script>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('sk_deskripsi');
        CKEDITOR.replace('sk_table');
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
                <li class="breadcrumb-item"><a href="{{ route('surat_keluar.index') }}">Surat Keluar</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </div>
    </div>
@endsection

@section('app')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('surat_keluar.update',$keluar->sk_id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group row mt-3">
                            <div class="col-6">
                                <label for="js_id" class="col-form-label text-dark">Jenis Surat <span
                                        class="text-danger">*</span></label>
                                <select name="js_id" id="jenis_surat" class="form-control form-control-sm">
                                    @foreach ($surat as $s)
                                        @if (old('js_id',$keluar->js_id) == $s->js_id)
                                            <option name="js_id" value="{!! $s->js_id !!}" selected>
                                                {!! $s->js_jenis !!}</option>
                                        @else
                                            <option name="js_id" value="{!! $s->js_id !!}">
                                                {!! $s->js_jenis !!}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="sk_asal" class="col-form-label text-dark">Asal Surat <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="sk_asal"
                                    placeholder="Asal Surat" name="sk_asal" value="{{ old('sk_asal', $com->com_name) }}"
                                    readonly required>
                                @error('sk_asal')
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
                                        @if (old('bid_id',$keluar->bid_id) == $b->bid_id)
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
                                        @if (old('sub_id',$keluar->sub_id) == $s->sub_id)
                                            <option value="{{ $s->sub_id }}" selected>{{ $s->sub_name }}</option>
                                        @else
                                            <option value="{{ $s->sub_id }}">{{ $s->sub_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-6">
                                <label for="sk_sifat" class="col-form-label text-dark">Sifat <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="sk_sifat"
                                    placeholder="Sifat Surat" name="sk_sifat" value="{{ old('sk_sifat',$keluar->sk_sifat) }}" required>
                                @error('sk_sifat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="sk_perihal" class="col-form-label text-dark">Perihal <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="sk_perihal"
                                    placeholder="Perihal Surat" name="sk_perihal" value="{{ old('sk_perihal',$keluar->sk_perihal) }}" required>
                                @error('sk_perihal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-6">
                                <label for="sk_tujuan" class="col-form-label text-dark">Tujuan <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="sk_tujuan"
                                    placeholder="Tujuan Surat" name="sk_tujuan" value="{{ old('sk_tujuan',$keluar->sk_tujuan) }}" required>
                                @error('sk_tujuan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="sk_tempat_tujuan" class="col-form-label text-dark">Tempat Tujuan Surat <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="sk_tempat_tujuan"
                                    placeholder="Ex: Samarinda" name="sk_tempat_tujuan" value="{{ old('sk_tempat_tujuan',$keluar->sk_tempat_tujuan) }}" required>
                                @error('sk_tempat_tujuan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-12">
                                <label for="sk_no" class="col-form-label text-dark">Nomor Surat <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="sk_no"
                                    placeholder="Nomor Surat" name="sk_no" value="{{ old('sk_no',$keluar->sk_no) }}" required>
                                @error('sk_no')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-12">
                                <label for="checkFile" class="col-form-label text-dark">Include File?</label>
                                <input type="checkbox" name="checkFile" id="checkFile">
                            </div>
                            <div class="col-12 d-none" id="fileData">
                                <label for="sk_file" class="col-form-label text-dark">File Surat <span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control-file" id="sk_file" name="sk_file">
                                @error('sk_file')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-12">
                                <label for="sk_deskripsi" class="col-form-label text-dark">Deskripsi </label>
                                <textarea name="sk_deskripsi" id="sk_deskripsi" rows="10" cols="100">{{ old('sk_deskripsi',$keluar->sk_deskripsi) }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-12">
                                <label for="sk_table" class="col-form-label text-dark">Approval Table </label>
                                <textarea name="sk_table" id="sk_table" rows="10" cols="100">{{ old('sk_table',$keluar->sk_table) }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-12 d-flex justify-content-center">
                                <a href="{{ route('surat_keluar.index') }}" class="btn btn-sm btn-info mx-2"><i
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
