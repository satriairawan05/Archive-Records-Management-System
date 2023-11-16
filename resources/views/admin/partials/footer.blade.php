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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.33/moment-timezone-with-data.min.js"></script>
    <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/moment/moment-with-timezone.min.js') }}"></script>
    <script src="{{ asset('vendor/moment/moment-with-locale.min.js') }}"></script>

    <script src="{{ asset('vendor/highlightjs/highlight.pack.min.js') }}"></script>
    <!-- Circle progress -->

    <script type="text/javascript">
        let datetime = null,
            date = null;

        let updateTime = function() {
            date = moment(new Date()).tz('Asia/Makassar');
            datetime.html(date.format('dddd, DD MMMM YYYY, HH:mm:ss z'));
        };

        $(document).ready(function() {
            moment.locale('id');
            datetime = $('#datetime')
            updateTime();
            setInterval(updateTime, 1000);

            $('.hamburger').click(function() {
                $('.brand-logo').toggleClass('show');
            });
        });
    </script>

    </body>

    </html>
