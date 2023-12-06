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
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}"
        type="text/css">
    <style>
        .kop {
            line-height: 1;
        }
    </style>
</head>

<body>
    <div class="container">
        <table align="center" class="kop">
            <tr>
                <td><img src="{{ asset('images/kota_samarinda.png') }}" alt="Pemkot"
                        style="width: 90px; height: 100px;"></td>
                <td align="center">
                    <font size="4">PEMERINTAH KOTA SAMARINDA</font><br>
                    <font size="6"><b>#</b></font><br>
                    <font size="2">Alamat : # Telp/Fax #
                        Email: #</font><br>
                    <font size="3"># KODE POS:#</font>
                </td>
            </tr>
            <tr>
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
