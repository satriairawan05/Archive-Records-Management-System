    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('js/quixnav-init.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

    <!-- Moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.33/moment-timezone-with-data.min.js"></script>
    <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/moment/moment-with-timezone.min.js') }}"></script>
    <script src="{{ asset('vendor/moment/moment-with-locale.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/time.js') }}"></script>

    <!-- Hightlight JS -->
    <script src="{{ asset('vendor/highlightjs/highlight.pack.min.js') }}"></script>

    @stack('js')

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    @if (session('success'))
        <script type="text/javascript">
            let timerInterval;
            Swal.fire({
                title: "Success!",
                text: "{{ session('success') }}",
                timer: 5000,
                icon: 'success',
                timerProgressBar: true,
                confirmButtonText: 'Oke',
                didOpen: () => {
                    timerInterval = setInterval(() => {}, 100)
                },
                willClose: () => {

                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {

                }
            });
        </script>
    @endif
    @if (session('failed'))
        <script type="text/javascript">
            let timerInterval;
            Swal.fire({
                title: "Fail!",
                text: "{{ session('failed') }}",
                timer: 500000,
                icon: 'error',
                timerProgressBar: true,
                confirmButtonText: 'Oke',
                didOpen: () => {
                    timerInterval = setInterval(() => {}, 100)
                },
                willClose: () => {

                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {

                }
            });
        </script>
    @endif

    </body>

    </html>
