@extends('admin.layout.app')

@push('css')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">

    <style type="text/css">
        #showHidePassword {
            position: relative;
        }

        #togglePassword,
        #togglePasswordConfirm {
            position: absolute;
            top: 74%;
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

            $('#togglePasswordConfirm i').click(function(event) {
                event.preventDefault();
                const passwordConfirmInput = $('#password-confirm');
                const toggleConfirmPassword = $('#togglePasswordConfirm i');

                if (passwordConfirmInput.attr('type') === 'text') {
                    passwordConfirmInput.attr('type', 'password');
                    toggleConfirmPassword.removeClass('fa-eye-slash').addClass('fa-eye');
                } else if (passwordConfirmInput.attr('type') === 'password') {
                    passwordConfirmInput.attr('type', 'text');
                    toggleConfirmPassword.removeClass('fa-eye').addClass('fa-eye-slash');
                }
            });
        });
    </script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('vendor/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        // single select box
        $("#group").select2();

        $("#bidang").select2();

        $("#sub-bidang").select2();
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
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
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
                    <form action="{{ route('user.update',$user->id) }}" method="post">
                        @csrf
                        <div class="form-group row mt-3">
                            <div class="col-6">
                                <label for="name" class="col-form-label text-dark">Name <span
                                        class="text-danger">*</span> </label>
                                <input type="text"
                                    class="form-control form-control-sm @error('name')
                                    is-invalid
                                @enderror"
                                    id="name" placeholder="Masukan Nama" value="{{ old('name',$user->name) }}" name="name"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="email" class="col-form-label text-dark">Email <span
                                        class="text-danger">*</span> </label>
                                <input type="text"
                                    class="form-control form-control-sm @error('email')
                                    is-invalid
                                @enderror"
                                    id="email" placeholder="Masukan Email" value="{{ old('email',$user->email) }}" name="email"
                                    required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-6">
                                <label for="password" class="col-form-label text-dark">Password <span
                                        class="text-danger">*</span> </label>
                                <input type="text"
                                    class="form-control form-control-sm @error('password')
                                    is-invalid
                                @enderror"
                                    id="passwordInput" placeholder="Masukan Password" value="{{ old('password') }}"
                                    name="password" required>
                                <a href="javascript:;" id="togglePassword" class="bg-transparent"><i
                                        class="fa fa-eye"></i></a>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="password_confirmation" class="col-form-label text-dark">Confirm Password<span
                                        class="text-danger">*</span></label>
                                <input type="password" id="password-confirm" name="password_confirmation"
                                    class="form-control form-control-sm" placeholder="Masukan Confirm Password" required>
                                <a href="javascript:;" id="togglePasswordConfirm" class="bg-transparent"><i
                                        class="fa fa-eye"></i></a>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-6">
                                <label for="position" class="col-form-label text-dark">Position <span
                                        class="text-danger">*</span> </label>
                                <input type="text"
                                    class="form-control form-control-sm @error('position')
                                    is-invalid
                                @enderror"
                                    id="position" placeholder="Masukan Position" value="{{ old('position',$user->position) }}"
                                    name="position" required>
                                @error('position')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="group_id" class="col-form-label text-dark">Role <span
                                        class="text-danger">*</span> </label>
                                <select id="group" name="group_id" class="form-control form-control-sm">
                                    @foreach ($group as $g)
                                        @if (old('group_id',$user->group_id) == $g->group_id)
                                            <option value="{{ $g->group_id }}" selected>{{ $g->group_name }}</option>
                                        @else
                                            <option value="{{ $g->group_id }}">{{ $g->group_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-6">
                                <label for="bid_id" class="col-form-label text-dark">Bidang <span
                                        class="text-danger">*</span> </label>
                                <select id="bidang" name="bid_id" class="form-control form-control-sm">
                                    @foreach ($bidang as $b)
                                        @if (old('bid_id',$user->bid_id) == $b->bid_id)
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
                                        @if (old('sub_id',$user->sub_id) == $s->sub_id)
                                            <option value="{{ $s->sub_id }}" selected>{{ $s->sub_name }}</option>
                                        @else
                                            <option value="{{ $s->sub_id }}">{{ $s->sub_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
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
