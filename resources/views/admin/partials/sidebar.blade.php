@php
    $pages = \App\Models\User::leftJoin('group_pages', 'users.group_id', '=', 'group_pages.group_id')
        ->leftJoin('groups', 'users.group_id', '=', 'groups.group_id')
        ->leftJoin('pages', 'group_pages.page_id', '=', 'pages.page_id')
        ->where('group_pages.access', '=', 1)
        ->where('group_pages.group_id', '=', auth()->user()->group_id)
        ->select(['group_pages.access', 'pages.page_name', 'pages.action'])
        ->get();

    // $approval = \App\Models\Approval::where('user_id', auth()->user()->id)
    //    ->whereNull('app_date')
    //    ->first();

    $countSK = \App\Models\SuratKeluar::leftJoin('approvals', 'surat_keluars.sk_id', '=', 'approvals.sk_id');

    if (auth()->user()->bid_id != null && auth()->user()->sub_id != null) {
        $countSK = $countSK
            ->where('surat_keluars.bid_id', auth()->user()->bid_id)
            ->where('surat_keluars.sub_id', auth()->user()->sub_id)
            ->where('approvals.user_id', auth()->user()->id)
            ->whereNull('approvals.app_date');
    } elseif (auth()->user()->bid_id != null) {
        $countSK = $countSK
            ->where('surat_keluars.bid_id', auth()->user()->bid_id)
            ->where('approvals.user_id', auth()->user()->id)
            ->whereNull('approvals.app_date');
    } else {
        $countSK = $countSK->where('approvals.user_id', auth()->user()->id)->whereNull('approvals.app_date');
    }

    $countSKValue = $countSK->count();

    $createSM = 0;
    $createSK = 0;
    $readSM = 0;
    $readSK = 0;
    $readArchive = 0;
    $readJS = 0;
    $readCom = 0;
    $readBid = 0;
    $readSub = 0;
    $readApproval = 0;
    $readUser = 0;

    foreach ($pages as $r) {
        if ($r->page_name == 'Surat Masuk') {
            if ($r->action == 'Create') {
                $createSM = $r->access;
            }

            if ($r->action == 'Read') {
                $readSM = $r->access;
            }
        }

        if ($r->page_name == 'Surat Keluar') {
            if ($r->action == 'Create') {
                $createSK = $r->access;
            }

            if ($r->action == 'Read') {
                $readSK = $r->access;
            }
        }

        if ($r->page_name == 'Archive') {
            if ($r->action == 'Read') {
                $readArchive = $r->access;
            }
        }

        if ($r->page_name == 'Jenis Surat') {
            if ($r->action == 'Read') {
                $readJS = $r->access;
            }
        }

        if ($r->page_name == 'Perusahaan') {
            if ($r->action == 'Read') {
                $readCom = $r->access;
            }
        }

        if ($r->page_name == 'Bidang') {
            if ($r->action == 'Read') {
                $readBid = $r->access;
            }
        }

        if ($r->page_name == 'Sub Bidang') {
            if ($r->action == 'Read') {
                $readSub = $r->access;
            }
        }

        if ($r->page_name == 'User') {
            if ($r->action == 'Read') {
                $readUser = $r->access;
            }
        }

        if ($r->page_name == 'Approval') {
            if ($r->action == 'Read') {
                $readApproval = $r->access;
            }
        }
    }
@endphp

<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            <li><a href="{{ route('home') }}"><i class="fa fa-home"></i><span class="nav-text">Dashboard</span></a>
            </li>

            @if ($createSM == 1 || $createSK == 1)
                <li class="nav-label">Registration</li>
                @if ($createSM == 1)
                    <li><a href="{{ route('surat_masuk.create') }}"><i class="fa fa-envelope-open"></i><span
                                class="nav-text">Surat Masuk</span></a></li>
                @endif
                @if ($createSK == 1)
                    <li><a href="{{ route('surat_keluar.create') }}"><i class="fa fa-envelope-o"></i><span
                                class="nav-text">Surat Keluar</span></a></li>
                @endif
            @endif

            @if ($readSM == 1 || $readSK == 1 || $readArchive == 1)
                <li class="nav-label">Bank File</li>
                @if ($readSM == 1)
                    <li><a href="{{ route('surat_masuk.index') }}"><i class="fa fa-envelope-open"></i><span
                                class="nav-text">Surat Masuk</span></a></li>
                @endif
                @if ($readSK == 1)
                    <li><a href="{{ route('surat_keluar.index') }}"><i class="fa fa-envelope-o"></i><span
                                class="nav-text">Surat Keluar
                                @if ($countSKValue > 0)
                                    <span class="badge badge-info">{!! $countSKValue !!}</span>
                                @endif
                            </span>
                        </a>
                    </li>
                @endif
                @if ($readArchive == 1)
                    <li><a href="{{ route('archives') }}"><i class="fa fa-archive"></i><span
                                class="nav-text">Archives</span></a></li>
                @endif

            @endif

            @if ($readJS == 1 || $readCom == 1 || $readBid == 1 || $readSub == 1 || $readUser == 1 || $readApproval == 1)
                <li class="nav-label">Setting</li>
                @if ($readJS == 1)
                    <li><a href="{{ route('jenis_surat.index') }}"><i class="fa fa-envelope-square"><span
                                    class="nav-text">
                                    Jenis Surat</span></i></a></li>
                @endif
                @if ($readCom == 1 || $readBid == 1 || $readSub == 1)
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="fa fa-building"></i><span class="nav-text">Profile</span></a>
                        <ul aria-expanded="false">
                            @if ($readCom == 1)
                                <li><a href="{{ route('perusahaan.index') }}">Company</a></li>
                            @endif
                            @if ($readBid == 1)
                                <li><a href="{{ route('bidang.index') }}">Bidang</a></li>
                            @endif
                            @if ($readSub == 1)
                                <li><a href="{{ route('sub_bidang.index') }}">Sub Bidang</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if ($readUser == 1)
                    <li><a href="{{ route('user.index') }}"><i class="fa fa-users"><span class="nav-text">
                                    Users</span></i></a>
                    </li>
                @endif
                @if ($readApproval == 1)
                    <li><a href="{{ route('approval.index') }}"><i class="fa fa-bookmark"><span class="nav-text">
                                    Approval</span></i></a></li>
                @endif
                @if (auth()->user()->group_id == 1)
                    <li><a href="{{ route('role.index') }}"><i class="fa fa-cog"><span class="nav-text">
                                    Role</span></i></a>
                    </li>
                @endif
            @endif
        </ul>
    </div>
</div>
