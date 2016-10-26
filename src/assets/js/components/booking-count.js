/**
 * Component: Booking Count
 *
 * Vue Component gets the number of pending bookings
 */
new Vue({
    el: '#bookingCount',
    data: {
        bookingCount: 0
    },
    beforeCreate: function () {
        var self = this;

        this.$http.get('/api/admin/booking/all',
            {
                emulateHTTP: true,
                emulateJSON: true,
                params: {'status': 'pending'}
            })
            .then(function (success) {
                console.log(success);
                self.bookingCount = success.body.data.length;
            });
    }
})