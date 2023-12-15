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
                <li class="breadcrumb-item active">Archives</li>
            </ol>
        </div>
    </div>
@endsection

@section('app')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="list-group">
                        @foreach ($bidang as $d)
                            @php
                                $skCount = \App\Models\SuratKeluar::where('bid_id', auth()->user()->bid_id != null ? auth()->user()->bid_id : $d->bid_id)
                                    ->whereNotNull('sk_no')
                                    ->count();
                            @endphp
                            <a href="?bidang_id={{ auth()->user()->bid_id != null ? auth()->user()->bid_id : $d->bid_id }}"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">{{ $d->bid_name }}
                                <span
                                    class="badge rounded-pill @if ($skCount == 0) bg-secondary @else bg-primary @endif text-white">
                                    {{ $skCount == 0 ? 'Empty Data' : $skCount }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
