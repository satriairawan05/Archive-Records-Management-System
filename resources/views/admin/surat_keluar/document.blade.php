<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }} || Print</title>
    <!-- Favicon icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('images/site.webmanifest') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css">
    <style>
        :root {
            margin: 0;
            padding: 0;
        }

        @media print {
            @page {
                size: A4 portrait;
            }
        }
    </style>
</head>

<body>
    <div class="mt-2">
        <table align="center" style="width: 100%; max-width: 800px;">
            <tr style="width: 100%;">
                <td>
                    <img src="{{ asset('images/kota_samarinda.png') }}" alt="Pemkot"
                        style="width: 120px; height: 130px;">
                </td>
                <td align="center">
                    <h4><b>PEMERINTAH KOTA SAMARINDA</b></h4>
                    <h2>DINAS PERHUBUNGAN</h2>
                    <h5 style="word-wrap: break-word; max-width: 800px;">Alamat : Jl. MT. Haryono, Kel
                        Air Putih, Kec. Samarinda Ulu</h5>
                    <h5 style="word-wrap: break-word; max-width: 800px;">Samarinda (Kalimantan Timur)
                        Kode Pos 75124</h5>
                    <h6 style="display: flex; justify-content: space-between;">
                        <p style="margin: 0;">https://dishub.samarindakota.go.id/</p>
                        <p style="margin: 0;">Email: dishub@samarindakota.go.id</p>
                    </h6>
                </td>
            </tr>
            <tr style="width: 100%; margin: 0;">
                <td colspan="2">
                    <hr style="border: 2px solid">
                </td>
            </tr>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>
