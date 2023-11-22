@php
    $pages = \App\Models\User::leftJoin('group_pages', 'users.group_id', '=', 'group_pages.group_id')
        ->leftJoin('groups', 'users.group_id', '=', 'groups.group_id')
        ->leftJoin('pages', 'group_pages.page_id', '=', 'pages.page_id')
        ->where('group_pages.access', '=', 1)
        ->where('group_pages.group_id', '=', auth()->user()->group_id)
        ->select(['group_pages.access', 'pages.page_name', 'pages.action'])
        ->get();
@endphp

<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            <li><a href="{{ route('home') }}"><i class="fa fa-home"></i><span class="nav-text">Dashboard</span></a>
            </li>

            <li class="nav-label">Registration</li>
            <li><a href="{{ route('surat_masuk.create') }}"><i class="fa fa-envelope-open"></i><span
                        class="nav-text">Surat Masuk</span></a></li>
            <li><a href="{{ route('surat_keluar.create') }}"><i class="fa fa-envelope-o"></i><span
                        class="nav-text">Surat Keluar</span></a></li>

            <li class="nav-label">Bank File</li>
            <li><a href="{{ route('surat_masuk.index') }}"><i class="fa fa-envelope-open"></i><span
                        class="nav-text">Surat Masuk</span></a></li>
            <li><a href="{{ route('surat_keluar.index') }}"><i class="fa fa-envelope-o"></i><span class="nav-text">Surat
                        Keluar</span></a></li>
            <li><a href="{{ route('archives') }}"><i class="fa fa-archive"></i><span
                        class="nav-text">Archives</span></a></li>

            <li class="nav-label">Setting</li>
            <li><a href="{{ route('jenis_surat.index') }}"><i class="fa fa-envelope-square"><span class="nav-text">
                            Jenis Surat</span></i></a></li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="fa fa-building"></i><span class="nav-text">Profile</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('perusahaan.index') }}">Company</a></li>
                    <li><a href="{{ route('bidang.index') }}">Bidang</a></li>
                    <li><a href="{{ route('sub_bidang.index') }}">Sub Bidang</a></li>
                </ul>
            </li>
            <li><a href="{{ route('user.index') }}"><i class="fa fa-users"><span class="nav-text"> Users</span></i></a>
            </li>
            @if (auth()->user()->group_id == 1)
                <li><a href="{{ route('role.index') }}"><i class="fa fa-cog"><span class="nav-text"> Role</span></i></a>
                </li>
            @endif
        </ul>
    </div>
</div>
