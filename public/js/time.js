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
        });