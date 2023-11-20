@extends('admin.layout.app')

@push('css')
    <style type="text/css">
        #showHidePassword {
            position: relative;
        }

        .red-star::after {
            content: '*';
            color: red;
        }

        #togglePassword,
        #togglePasswordConfirm {
            position: absolute;
            top: 45%;
            right: 24px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#togglePassword i').click(function(event) {
                event.preventDefault();
                const passwordInput = $('#passwordInput');
                const togglePassword = $('#togglePassword i');

                if (passwordInput.attr('type') === 'text') {
                    passwordInput.attr('type', 'password');
                    togglePassword.removeClass('fa-eye-slash').addClass('fa-eye');
                } else if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    togglePassword.removeClass('fa-eye').addClass('fa-eye-slash');
                }
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
                            <div class="col-2">
                                <label for="password" class="col-form-label text-dark">Password <span
                                        class="text-danger">*</span> </label>
                            </div>
                            <div class="col-10">
                                <input type="text"
                                    class="form-control form-control-sm @error('password')
                                    is-invalid
                                @enderror"
                                    id="passwordInput" placeholder="Masukan Password" value="{{ old('password') }}" name="password"
                                    required>
                                    <a href="javascript:;" id="togglePassword" class="bg-transparent"><i
                                        class="fa fa-eye"></i></a>
                                @error('password')
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
