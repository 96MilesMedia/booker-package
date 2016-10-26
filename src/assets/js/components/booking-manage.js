/**
 * Component: Booking Manage
 *
 * Vue Component retrieves all bookings
 * and handles the deletion of individual items.
 *
 * Still a work in progress, VueJS seems to have removed
 * some decent functionality for handling deletion so
 * this implementation feels very hacky at the moment.
 */
var vm = new Vue({
    el: '#bookingsManage',
    data: {
        bookings: []
    },
    beforeCreate: function () {
        var self = this;
        this.$http.get('/api/booking/' + bookingDate, {}, {method: 'GET', emulateHTTP: true, emulateJSON: true})
            .then(function (success) {
                console.log(success.body.data);
                self.bookings = success.body.data;
            });
    },
    methods: {
        completeBooking: function ($event, item) {
            $event.preventDefault();

            var dialog = this.actionModal();

            var _this = this;

            dialog.querySelector('.agree').addEventListener('click', function() {

                _this.$http.put('/api/booking/' + item.uid, {
                    'status' : 'completed'
                }).then(function (success) {
                    item.status = 'completed';
                    dialog.close();
                });
            });
        },
        actionModal: function () {
            var dialog = document.querySelector('dialog');

            if (! dialog.showModal) {
                dialogPolyfill.registerDialog(dialog);
            }

            dialog.showModal();

            dialog.querySelector('.close').addEventListener('click', function() {
                dialog.close();
            });

            return dialog;
        },
        deleteBooking: function (event, item) {
            event.preventDefault();

            var _this = this;

            dialog.querySelector('.agree').addEventListener('click', function() {

                var _that = _this;

                _this.$http.delete('/api/admin/booking/' + item.uid)
                    .then(function (success) {
                        if (success.status == 200) {

                            // _that.bookings.$remove(item.uid);

                            // Settling for this at the moment as it seems VueJs removed the very
                            // useful method of $remove and every other method possible does not work to
                            // delete one item from the property!!!
                            this.$http.get('/api/admin/booking/all', {}, {method: 'GET', emulateHTTP: true, emulateJSON: true})
                                .then(function (success) {
                                    _this.bookings = success.body.data;
                                });

                            dialog.close();
                        }
                    });
            });
        },
        viewBooking: function (event, item) {
            event.preventDefault();

            window.location = viewRoute + '/' + item.uid;
        }
    }
})