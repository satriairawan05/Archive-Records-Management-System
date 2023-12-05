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
        $("#jenis_surat").select2();

        $("#bidang").select2();

        $("#sub-bidang").select2();

        $("#company").select2();
    </script>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('sk_deskripsi');
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
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </div>
    </div>
@endsection

@section('app')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('surat_keluar.store') }}" method="post">
                        @csrf
                        <div class="form-group row mt-3">
                            <div class="col-6">
                                <label for="js_id" class="col-form-label text-dark">Jenis Surat <span
                                        class="text-danger">*</span></label>
                                <select name="js_id" id="jenis_surat" class="form-control form-control-sm">
                                    @foreach ($surat as $s)
                                        @if (old('js_id') == $s->js_id)
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
                            <div class="col-6">
                                <label for="sk_sifat" class="col-form-label text-dark">Sifat <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="sk_sifat"
                                    placeholder="Sifat Surat" name="sk_sifat" value="{{ old('sk_sifat') }}" required>
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
                                    placeholder="Perihal Surat" name="sk_perihal" value="{{ old('sk_perihal') }}" required>
                                @error('sk_perihal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-6">
                                <label for="sk_asal" class="col-form-label text-dark">Asal <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="sk_asal"
                                    placeholder="Asal Surat" name="sk_asal" value="{{ old('sk_asal',$com->com_name) }}" readonly required>
                                @error('sk_asal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="sk_tujuan" class="col-form-label text-dark">Tujuan <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="sk_tujuan"
                                    placeholder="Tujuan Surat" name="sk_tujuan" value="{{ old('sk_tujuan') }}" required>
                                @error('sk_tujuan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-12">
                                <label for="sk_deskripsi" class="col-form-label text-dark">Deskripsi <span
                                        class="text-danger">*</span> </label>
                                <textarea name="sk_deskripsi" id="sk_deskripsi" rows="10" cols="100">{{ old('sk_deskripsi') }}</textarea>
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
