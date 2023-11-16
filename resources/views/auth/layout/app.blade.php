@include('auth.partials.header')
<div class="authincation h-100">
    <div class="container-fluid h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                @yield('auth')
            </div>
        </div>
    </div>
</div>
@include('auth.partials.footer')
