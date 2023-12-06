<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }} || Print</title>
</head>
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.12/pdfobject.min.js"
        integrity="sha512-lDL6DD6x4foKuSTkRUKIMQJAoisDeojVPXknggl4fZWMr2/M/hMiKLs6sqUvxP/T2zXdrDMbLJ0/ru8QSZrnoQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        if (PDFObject.supportsPDFs) {
            console.log("Yay, this browser supports inline PDFs.");
        } else {
            console.log("Boo, inline PDFs are not supported by this browser");
        }

        PDFObject.embed("{{ asset('storage/' . $surat->sm_file) }}", document.body)
    </script>
</body>
</html>
