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
        // single select box
        $("#bidang").select2();
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
                <li class="breadcrumb-item"><a href="{{ route('sub_bidang.index') }}">Sub Bidang</a></li>
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
                    <form action="{{ route('sub_bidang.store') }}" method="post">
                        @csrf
                        <div class="form-group row mt-3">
                            <div class="col-6">
                                <label for="sub_name" class="col-form-label text-dark">Nama Sub Bidang <span
                                        class="text-danger">*</span> </label>
                                <input type="text"
                                    class="form-control form-control-sm @error('sub_name')
                                    is-invalid
                                @enderror"
                                    id="sub_name" placeholder="Masukan Nama Sub Bidang" value="{{ old('sub_name') }}"
                                    name="sub_name" required>
                                @error('com_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="sub_alias" class="col-form-label text-dark">Alias Sub Bidang <span
                                        class="text-danger">*</span> </label>
                                <input type="text"
                                    class="form-control form-control-sm @error('sub_alias')
                                    is-invalid
                                @enderror"
                                    id="sub_alias" placeholder="Masukan Alias Sub Bidang" value="{{ old('sub_alias') }}"
                                    name="sub_alias" required>
                                @error('bid_alias')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-12">
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
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-12 d-flex justify-content-center">
                                <a href="{{ route('sub_bidang.index') }}" class="btn btn-sm btn-info mx-2"><i
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
