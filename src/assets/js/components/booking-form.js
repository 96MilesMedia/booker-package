/**
 * Component: Booking Form
 *
 * Handles the assigning of data to a booking form.
 *
 * At the moment this is handled by Laravel actually
 * returning the booking data on the controller method
 * being loaded - but may actually change this to load
 * the data on the fly with a seperate API point.
 */
var bookingForm = new Vue({
    el: '#bookingForm',
    data: booking.data,
    watch: {
        date: function (value) {
            console.log("watching");
            this.getBookings(value);
        }
    },
    methods: {

        reloadDate: function () {
            this.getBookings(this.date);
        },

        getBookings: function (value) {

            var newDate = moment(value, 'DD-MM-YYYY').format('YYYY-MM-DD');

            this.$http.get('/api/booking/' + newDate + '/valid',
            {
                emulateHTTP: true,
                emulateJSON: true
            })
            .then(function (success) {
                var data = success.body.data;

                this.loadTImes(data);
            });
        },

        loadTImes: function (data) {

            // Load the settings from the storage
            var settings = JSON.parse(localStorage.getItem('BOOKING_SETTINGS'));

            /**
             * As the timepicker annoyingly formats the time
             * without a pre-pending zero on the times under 10,
             * the momentjs requires the zero before hand to be
             * a valid time.
             * (It's late and thats what it was looking like I'm beginning to question that now)
             *
             * Therefore this formats the time in a really horrible way
             * as we have the am/pm attached to the string
             *
             * @param  {String} time
             * @return {String}
             */
            function formatTime(time) {
                var split = time.split(':');
                var newTime;

                if (split[0] <= 9) {
                    newTime = '0'+split[0];
                }

                newTime = newTime + ':' + split[1].slice(0, 2);

                return newTime;
            }

            // Organise times that have been pre-booked
            var timesBooked = [];
            $.each(data, function (index, value) {

                var rangeFrom = String(value.time);

                // Format date
                var newDate = moment(value.date, 'DD-MM-YYYY').format('YYYY-MM-DD');
                var formattedTime = formatTime(rangeFrom);

                var formattedDate = newDate + 'T' + formattedTime;

                // Calculate the range of the booking e.g 10:30am with a time_allocation of 30 minutes should have 10:30am
                var hour = moment(formattedDate).add(settings.time_allocation, 'minutes').hour();
                var minutes = moment(formattedDate).add(settings.time_allocation, 'minutes').minutes();
                // Repeated code here of the formattedTime function but this attaches the same am/pm
                // however it's not being clever nor intuitive if it runs over 12:30am to pm...
                var timeSplit = rangeFrom.split(':');
                var amPm = timeSplit[1].slice(2, 5);
                var rangeTo = hour + ':' + minutes + amPm;

                var range = [
                    rangeFrom,
                    rangeTo
                ];

                timesBooked.push(range);

            });

            var timePickerSettings = {
                disableTimeRanges: timesBooked,
                minTime: settings.opening_time,
                maxTime: settings.closing_time,
                step: settings.time_allocation,
                forceRoundTime: true
            };

            $('#time').timepicker(timePickerSettings);

            this.timeActive = true;
        }
    }
});

// Directive binding just seems so overly convuluted
$('#date').change(function() {
    var value = $(this).val();
    bookingForm.$data.date = value;
});

$('#time').change(function() {
    var value = $(this).val();
    bookingForm.$data.time = value;
});