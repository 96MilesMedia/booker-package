/**
 * Component: Booking Count
 *
 * Vue Component gets the number of pending bookings
 */
var bookingSettingsCache = new Vue({
    beforeCreate: function () {

        var self = this;

        if (!localStorage.getItem('BOOKING_SETTINGS')) {

            this.$http.get('/api/settings/booking',
                {
                    emulateHTTP: true,
                    emulateJSON: true
                })
                .then(function (success) {
                    localStorage.setItem('BOOKING_SETTINGS', JSON.stringify(success.body.data));

                });
        }
    }
});