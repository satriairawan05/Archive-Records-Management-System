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
                <li class="breadcrumb-item"><a href="{{ route('archives') }}">Archive</a></li>
                <li class="breadcrumb-item active">{{ $bidang->bid_name }}</li>
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
                        @if (auth()->user()->bid_id != null && auth()->user()->sub_id != null)
                            @php
                                $skCount = \App\Models\SuratKeluar::where('bid_id', auth()->user()->bid_id)
                                    ->where('sub_id', auth()->user()->sub_id)
                                    ->whereNotNull('sk_remark')
                                    ->count();
                                $subBidangUser = \App\Models\SubBidang::where('sub_id', auth()->user()->sub_id)->first();
                            @endphp
                            <a href="?bidang_id={{ auth()->user()->bid_id }}&sub_id={{ auth()->user()->sub_id }}"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">{{ $subBidangUser->sub_name }}
                                <span
                                    class="badge rounded-pill @if ($skCount == 0) bg-secondary @else bg-primary @endif text-white">
                                    {{ $skCount == 0 ? 'Empty Data' : $skCount }}
                                </span>
                            </a>
                        @else
                            @if (auth()->user()->sub_id != null)
                                @php
                                    $skCount = \App\Models\SuratKeluar::where('bid_id', $bidang->bid_id)
                                        ->where('sub_id', auth()->user()->sub_id)
                                        ->whereNotNull('sk_remark')
                                        ->count();
                                @endphp
                                <a href="?bidang_id={{ $bidang->bid_id }}&sub_id={{ auth()->user()->sub_id }}"
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">{{ $d->sub_name }}
                                    <span
                                        class="badge rounded-pill @if ($skCount == 0) bg-secondary @else bg-primary @endif text-white">
                                        {{ $skCount == 0 ? 'Empty Data' : $skCount }}
                                    </span>
                                </a>
                            @else
                                @foreach ($sub as $d)
                                    @php
                                        $skCount = \App\Models\SuratKeluar::where('bid_id', $bidang->bid_id)
                                            ->where('sub_id', $d->sub_id)
                                            ->whereNotNull('sk_remark')
                                            ->count();
                                    @endphp
                                    <a href="?bidang_id={{ $bidang->bid_id }}&sub_id={{ $d->sub_id }}"
                                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">{{ $d->sub_name }}
                                        <span
                                            class="badge rounded-pill @if ($skCount == 0) bg-secondary @else bg-primary @endif text-white">
                                            {{ $skCount == 0 ? 'Empty Data' : $skCount }}
                                        </span>
                                    </a>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
