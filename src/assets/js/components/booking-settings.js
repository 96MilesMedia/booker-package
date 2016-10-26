/**
 * Component: Booking Count
 *
 * Vue Component gets the number of pending bookings
 */
var bookingSettings = new Vue({
    el: '#bookingSettings',
    data: {
        settings: {},
        formSubmitted: false
    },
    beforeCreate: function () {
        var self = this;

        this.$http.get('/api/settings/booking',
            {
                emulateHTTP: true,
                emulateJSON: true
            })
            .then(function (success) {
                console.log(success);
                self.settings = success.body.data;
            });
    },
    methods: {

        /**
         * Update the booking settings
         *
         * @param  {Object} event
         */
        updateSettings: function (event) {

            event.preventDefault();

            this.formSubmitted = true;
            self = this;

            this.$http.put('/api/admin/booking/settings', this.settings)
                .then(function (success) {

                    var data = success.body.data;

                    self.formSubmitted = false;

                    // Reset Local Storage
                    localStorage.setItem('BOOKING_SETTINGS', JSON.stringify(self.settings));

                    // Notify snackbar of success
                    this.notify("Booking Settings updated");
                });
        },

        /**
         * Pulls up snackbar to notify user of completion
         *
         * @param  {String} data
         */
        notify: function (data) {
            var notification = document.querySelector('.mdl-js-snackbar');

            notification.MaterialSnackbar.showSnackbar({
                message: data
            });
        }
    }
});

// Seems vue is messing up with the time plugin
// that it is not setting the value of the model
// when the input changes through the time selection
//
// Having to add an on change to pick up the change
// and manually setting the v-model
$('.time-general').change(function() {
    var value = $(this).val();
    var id = $(this).attr('id');

    bookingSettings.$data.settings[id] = value;
});