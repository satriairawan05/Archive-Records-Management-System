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
                <li class="breadcrumb-item"><a href="{{ route('perusahaan.index') }}">Perusahaan</a></li>
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
                    <form action="{{ route('perusahaan.store') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="com_name" class="col-form-label text-dark">Nama Perusahaan/Organisasi <span
                                        class="text-danger">*</span> </label>
                                <input type="text"
                                    class="form-control form-control-sm @error('com_name')
                                    is-invalid
                                @enderror"
                                    id="com_name" placeholder="Masukan Nama Perusahaan/Organisasi" value="{{ old('com_name') }}"
                                    name="com_name" required>
                                @error('com_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="com_alias" class="col-form-label text-dark">Alias/Singkatan <span
                                        class="text-danger">*</span> </label>
                                <input type="text"
                                    class="form-control form-control-sm @error('com_alias')
                                    is-invalid
                                @enderror"
                                    id="com_alias" placeholder="Masukan Alias/Singkatan" value="{{ old('com_alias') }}"
                                    name="com_alias" required>
                                @error('com_alias')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-6">
                                <label for="com_address" class="col-form-label text-dark">Alamat <span
                                        class="text-danger">*</span> </label>
                                <input type="text"
                                    class="form-control form-control-sm @error('com_address')
                                    is-invalid
                                @enderror"
                                    id="com_address" placeholder="Masukan Alamat" value="{{ old('com_address') }}"
                                    name="com_address" required>
                                @error('com_address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="com_phone" class="col-form-label text-dark">Nomor HP <span
                                        class="text-danger">*</span> </label>
                                <input type="text"
                                    class="form-control form-control-sm @error('com_phone')
                                    is-invalid
                                @enderror"
                                    id="com_phone" placeholder="Masukan Phone Number" value="{{ old('com_phone') }}"
                                    name="com_phone" required>
                                @error('com_phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-12 d-flex justify-content-center">
                                <a href="{{ route('perusahaan.index') }}" class="btn btn-sm btn-info mx-2"><i
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
