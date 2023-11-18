@extends('auth.layout.app')

@section('auth')
    <div class="authincation-content">
        <div class="row no-gutters">
            <div class="col-xl-12">
                @if (session('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Failed!</strong> {{ session('loginError') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="auth-form">
                    <h4 class="mb-4 text-center">{{ $name }}</h4>
                    <form action="index.html">
                        <div class="form-group">
                            <label><strong class="red-star">Name</strong></label>
                            <input type="text" class="form-control" name="name" placeholder="Masukan Nama" required autofocus>
                        </div>
                        <div class="form-group">
                            <label><strong class="red-star">Email</strong></label>
                            <input type="email" class="form-control" name="email" placeholder="Masukan Email" required>
                        </div>
                        <div class="form-group">
                            <label><strong class="red-star">Password</strong></label>
                            <div id="showHidePassword">
                                <input type="password" id="password" name="password" class="form-control"
                                    placeholder="Masukan Password" required>
                                <a href="javascript:;" id="togglePassword" class="bg-transparent"><i
                                        class="fa fa-eye"></i></a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><strong class="red-star">Confirm Password</strong></label>
                            <div id="showHidePassword">
                                <input type="password" id="password-confirm" name="password_confirmation"
                                    class="form-control" placeholder="Masukan Confirm Password" required>
                                <a href="javascript:;" id="togglePasswordConfirm" class="bg-transparent"><i
                                        class="fa fa-eye"></i></a>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <button type="submit" class="btn btn-primary btn-block">Sign me up</button>
                        </div>
                    </form>
                    <div class="new-account mt-3">
                        <p>Already have an account? <a class="text-primary" href="{{ route('login') }}">Sign in</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
            top: 52%;
            right: 18px;
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
                const passwordInput = $('#password');
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
@endpush
