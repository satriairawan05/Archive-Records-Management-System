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
                <li class="breadcrumb-item active"><a href="{{ route('user.index') }}">User</a></li>
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
                    <form action="{{ route('user.store') }}" method="post">
                        @csrf
                        <div class="form-group row mt-3">
                            <div class="col-2">
                                <label for="name" class="col-form-label text-dark">Name <span
                                        class="text-danger">*</span> </label>
                            </div>
                            <div class="col-10">
                                <input type="text"
                                    class="form-control form-control-sm @error('name')
                                    is-invalid
                                @enderror"
                                    id="name" placeholder="Masukan Nama" value="{{ old('name') }}" name="name"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-2">
                                <label for="email" class="col-form-label text-dark">Email <span
                                        class="text-danger">*</span> </label>
                            </div>
                            <div class="col-10">
                                <input type="text"
                                    class="form-control form-control-sm @error('email')
                                    is-invalid
                                @enderror"
                                    id="email" placeholder="Masukan Email" value="{{ old('email') }}" name="email"
                                    required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-12 d-flex justify-content-center">
                                <a href="{{ route('user.index') }}" class="btn btn-sm btn-info mx-2"><i
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
