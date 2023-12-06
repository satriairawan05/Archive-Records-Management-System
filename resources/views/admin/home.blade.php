@extends('admin.layout.app')

@section('breadcrumb')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Hi, welcome back {{ auth()->user()->name }}!</h4>
                <p class="mb-0">Welcome back to Archive Records Management System Di Dinas Perhubungan Kota Samarinda</p>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item active">{{ $name }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('app')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-uppercase text-dark text-center"><i class="fa fa-clock-o"></i> Actual Data {{ \Carbon\Carbon::now()->isoFormat('MMMM YYYY') }}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-one card-body">
                    <div class="stat-icon d-inline-block">
                        <i class="fa fa-envelope-open text-primary border-primary"></i>
                    </div>
                    <div class="stat-content d-inline-block">
                        <div class="stat-text">Surat Masuk</div>
                        <div class="stat-digit">{{ $smCount }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-one card-body">
                    <div class="stat-icon d-inline-block">
                        <i class="fa fa-envelope text-danger border-danger"></i>
                    </div>
                    <div class="stat-content d-inline-block">
                        <div class="stat-text">Surat Keluar (Waiting)</div>
                        <div class="stat-digit">{{ $skWait }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-one card-body">
                    <div class="stat-icon d-inline-block">
                        <i class="fa fa-envelope text-success border-success"></i>
                    </div>
                    <div class="stat-content d-inline-block">
                        <div class="stat-text">Surat Keluar (Accepted)</div>
                        <div class="stat-digit">{{ $skAcc }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-one card-body">
                    <div class="stat-icon d-inline-block">
                        <i class="fa fa-envelope-square text-primary border-primary"></i>
                    </div>
                    <div class="stat-content d-inline-block">
                        <div class="stat-text">Jenis Surat</div>
                        <div class="stat-digit">{{ $count }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
