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
                    <form action="{{ route('login_store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label><strong class="red-star">Email</strong></label>
                            <input type="email" name="email" class="form-control form-control-sm"
                                value="{{ old('email') }}" placeholder="Masukan Email" required autofocus>
                        </div>
                        <div class="form-group">
                            <label><strong class="red-star">Password</strong></label>
                            <div id="showHidePassword">
                                <input type="password" id="passwordInput" name="password"
                                    class="form-control form-control-sm" placeholder="Masukan Password">
                                <a href="javascript:;" id="togglePassword" class="bg-transparent"><i
                                        class="fa fa-eye"></i></a>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-block">Sign me in</button>
                        </div>
                    </form>
                    <div class="new-account mt-3">
                        <p>Don't have an account? <a class="text-primary" href="{{ route('register') }}">Sign up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
@endsection
