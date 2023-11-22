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
        $("#company").select2();
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
                <li class="breadcrumb-item"><a href="{{ route('bidang.index') }}">Bidang</a></li>
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
                    <form action="{{ route('bidang.update',$bidang->bid_id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group row mt-3">
                            <div class="col-6">
                                <label for="bid_name" class="col-form-label text-dark">Nama Bidang/Departemen <span
                                        class="text-danger">*</span> </label>
                                <input type="text"
                                    class="form-control form-control-sm @error('bid_name')
                                    is-invalid
                                @enderror"
                                    id="bid_name" placeholder="Masukan Nama Bidang/Departemen" value="{{ old('bid_name',$bidang->bid_name) }}"
                                    name="bid_name" required>
                                @error('com_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="bid_alias" class="col-form-label text-dark">Alias Bidang/Departemen <span
                                        class="text-danger">*</span> </label>
                                <input type="text"
                                    class="form-control form-control-sm @error('bid_alias')
                                    is-invalid
                                @enderror"
                                    id="bid_alias" placeholder="Masukan Alias Bidang/Departemen" value="{{ old('bid_alias',$bidang->bid_alias) }}"
                                    name="bid_alias" required>
                                @error('bid_alias')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-12">
                                <label for="com_id" class="col-form-label text-dark">Company <span
                                        class="text-danger">*</span> </label>
                                <select id="company" name="com_id" class="form-control form-control-sm">
                                    @foreach ($companies as $c)
                                        @if (old('com_id',$bidang->com_id) == $c->com_id)
                                            <option value="{{ $c->com_id }}" selected>{{ $c->com_name }}</option>
                                        @else
                                            <option value="{{ $c->com_id }}">{{ $c->com_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-12 d-flex justify-content-center">
                                <a href="{{ route('bidang.index') }}" class="btn btn-sm btn-info mx-2"><i
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
