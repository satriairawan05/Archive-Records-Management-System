<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('vendor/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css">
<style>
    :root {
        margin: 0;
        padding: 0;
    }

    .left-align {
        text-align: left;
    }

    .a4-size {
        display: none;
    }

    .letter-size {
        display: none;
    }

    @media print and (min-width: 8.3in) and (max-width: 8.5in) and (min-height: 11.7in) and (max-height: 11.9in) {
        :root {
            font-size:13px;
        }

        .a4-size {
            display: block;
        }

        .letter-size {
            display: none;
        }
    }

    @media print and (min-width: 8.3in) and (max-width: 8.5in) and (min-height: 10.9in) and (max-height: 11.1in) {
        :root {
            font-size:14px;
        }

        .a4-size {
            display: none;
        }

        .letter-size {
            display: block;
        }
    }

    @media print {
        @page {
            size: A4 portrait;
        }
    }
</style>
<div class="a4-size">
    <div class="container mt-4">
        <table align="center" style="width: 100%; max-width: 800px;">
            <thead>
                <tr style="width: 100%;">
                    <td>
                        <img src="{{ asset('images/kota_samarinda.png') }}" alt="Pemkot"
                            style="width: 130px; height: 140px;">
                    </td>
                    <td align="center">
                        <h2><b>PEMERINTAH KOTA SAMARINDA</b></h2>
                        <h4>DINAS PERHUBUNGAN</h4>
                        <h6 style="word-wrap: break-word; max-width: 800px;">Alamat : Jl. MT. Haryono, Kel
                            Air Putih, Kec. Samarinda Ulu</h6>
                        <h6 style="word-wrap: break-word; max-width: 800px;">Samarinda (Kalimantan Timur)
                            Kode Pos 75124</h6>
                        <h6 style="display: flex; justify-content: space-between;">
                            <p style="margin: 0; padding: 0;">https://dishub.samarindakota.go.id/</p>
                            <p style="margin: 0; padding: 0;">Email: dishub@samarindakota.go.id</p>
                        </h6>
                    </td>
                </tr>
                <tr style="width: 100%; max-width: 800px;">
                    <td colspan="2">
                        <hr style="border: 2px solid black;">
                    </td>
                </tr>
            </thead>
        </table>
        <div class="row" style="margin-top: 0;">
            <div class="col-6"></div>
            <div class="col-6">
                <h6 align="center">Samarinda,
                    {{ $surat->sk_tgl_old == $surat->sk_tgl ? \Carbon\Carbon::parse($surat->sk_tgl_old)->isoFormat('DD MMMM YYYY') : \Carbon\Carbon::parse($surat->sk_tgl)->isoFormat('DD MMMM YYYY') }}
                </h6><br>
            </div>
        </div>
        <div class="row" style="margin-top: 0;">
            <div class="col-6 mt-0" style="margin-left: 125px;">
                <h6 class="left-align" style="vertical-align:top;">Nomor
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                    {{ $surat->sk_no_old == $surat->sk_no ? $surat->sk_no_old : $surat->sk_no }}</h6>
                <h6 class="left-align" style="vertical-align:top;">Lampiran &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                    {{ $surat->sk_lampiran != null ? $surat->sk_lampiran : '-' }}</h6>
                <h6 class="left-align" style="vertical-align:top;">Perihal
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $surat->sk_perihal }}</h6>
            </div>
        </div>
        <div class="row mx-5 mt-2">
            <div class="col-6">
                <p style="margin-bottom: 0;">Yth. {{ $surat->sk_tujuan }}</p>
                <p style="margin-left: 20px; margin-top: 0; margin-bottom: 0;">di - </p>
                <p style="margin-left: 30px;">{{ $surat->sk_tempat_tujuan }}</p>
            </div>
            <div class="col-6"></div>
        </div>
        <div class="row mx-5">
            <div class="col-12" style="text-align: justify;">
                <p>{!! $surat->sk_deskripsi !!}</p>
            </div>
        </div>
        <div class="row mx-5">
            <div class="col-6">
                @if ($surat->sk_table != null)
                    <p>{!! $surat->sk_table !!}</p>
                @endif
            </div>
            <div class="col-6">
                <div style="padding-left: 80px; text-align: center;">
                    <h4 class="fs-6 h6">{{ $approval->position }}</h4>
                    <br>
                    <br>
                    <h4 class="fs-6 h6"><u>{{ $approval->name }}</u></h4>
                    <h4 class="fs-6 h6">NIP. {{ $approval->nip }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="letter-size">
    <div class="container mt-4">
        <table align="center" style="width: 100%; max-width: 800px;">
            <thead>
                <tr style="width: 100%;">
                    <td>
                        <img src="{{ asset('images/kota_samarinda.png') }}" alt="Pemkot"
                            style="width: 130px; height: 140px;">
                    </td>
                    <td align="center">
                        <h2><b>PEMERINTAH KOTA SAMARINDA</b></h2>
                        <h4>DINAS PERHUBUNGAN</h4>
                        <h6 style="word-wrap: break-word; max-width: 800px;">Alamat : Jl. MT. Haryono, Kel
                            Air Putih, Kec. Samarinda Ulu</h6>
                        <h6 style="word-wrap: break-word; max-width: 800px;">Samarinda (Kalimantan Timur)
                            Kode Pos 75124</h6>
                        <h6 style="display: flex; justify-content: space-between;">
                            <p style="margin: 0; padding: 0;">https://dishub.samarindakota.go.id/</p>
                            <p style="margin: 0; padding: 0;">Email: dishub@samarindakota.go.id</p>
                        </h6>
                    </td>
                </tr>
                <tr style="width: 100%; max-width: 800px;">
                    <td colspan="2">
                        <hr style="border: 2px solid black;">
                    </td>
                </tr>
            </thead>
        </table>
        <div class="row" style="margin-top: 0;">
            <div class="col-6"></div>
            <div class="col-6">
                <h6 align="center">Samarinda,
                    {{ $surat->sk_tgl_old == $surat->sk_tgl ? \Carbon\Carbon::parse($surat->sk_tgl_old)->isoFormat('DD MMMM YYYY') : \Carbon\Carbon::parse($surat->sk_tgl)->isoFormat('DD MMMM YYYY') }}
                </h6><br>
            </div>
        </div>
        <div class="row" style="margin-top: 0;">
            <div class="col-6 mt-0" style="margin-left: 125px;">
                <h6 class="left-align" style="vertical-align:top;">Nomor
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                    {{ $surat->sk_no_old == $surat->sk_no ? $surat->sk_no_old : $surat->sk_no }}</h6>
                <h6 class="left-align" style="vertical-align:top;">Lampiran &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                    {{ $surat->sk_lampiran != null ? $surat->sk_lampiran : '-' }}</h6>
                <h6 class="left-align" style="vertical-align:top;">Perihal
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $surat->sk_perihal }}</h6>
            </div>
        </div>
        <div class="row mx-5 mt-2">
            <div class="col-6">
                <p style="margin-bottom: 0;">Yth. {{ $surat->sk_tujuan }}</p>
                <p style="margin-left: 20px; margin-top: 0; margin-bottom: 0;">di - </p>
                <p style="margin-left: 30px;">{{ $surat->sk_tempat_tujuan }}</p>
            </div>
            <div class="col-6"></div>
        </div>
        <div class="row mx-5">
            <div class="col-12" style="text-align: justify;">
                <p>{!! $surat->sk_deskripsi !!}</p>
            </div>
        </div>
        <div class="row mx-5">
            <div class="col-6">
                @if ($surat->sk_table != null)
                    <p>{!! $surat->sk_table !!}</p>
                @endif
            </div>
            <div class="col-6">
                <div style="padding-left: 80px; text-align: center;">
                    <h4 class="fs-6 h6">{{ $approval->position }}</h4>
                    <br>
                    <br>
                    <h4 class="fs-6 h6"><u>{{ $approval->name }}</u></h4>
                    <h4 class="fs-6 h6">NIP. {{ $approval->nip }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
