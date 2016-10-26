/**
 * Component: Bookings
 *
 * Vue Component retrieves all bookings
 * and handles the deletion of individual items.
 *
 * Still a work in progress, VueJS seems to have removed
 * some decent functionality for handling deletion so
 * this implementation feels very hacky at the moment.
 */
var vm = new Vue({
    el: '#bookings',
    data: {
        bookings: [],
        field: 'date',
        reverse: 'desc'
    },
    beforeCreate: function () {
        var self = this;
        this.$http.get('/api/admin/booking/all', {}, {method: 'GET', emulateHTTP: true, emulateJSON: true})
            .then(function (success) {

                var data = success.body.data;

                self.bookings = data;
            });
    },
    methods: {

        /**
         * Removes a booking
         *
         * @param  {Object} event
         * @param  {Object} item
         */
        deleteBooking: function (event, item) {
            event.preventDefault();

            var dialog = document.querySelector('dialog');

            if (! dialog.showModal) {
                dialogPolyfill.registerDialog(dialog);
            }

            dialog.showModal();

            dialog.querySelector('.close').addEventListener('click', function() {
                dialog.close();
            });

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

        /**
         * View a booking
         *
         * @param  {Object} event
         * @param  {Object} item
         */
        viewBooking: function (event, item) {
            event.preventDefault();

            window.location = viewRoute + '/' + item.uid;
        },

        /**
         * Sets the column and direction to be sorted by
         *
         * @param  {Object} event
         * @param  {String} column
         */
        sortColumns: function (event, column) {
            event.preventDefault();

            var icon = $(event.target).children(0);

            this.field = column;
            this.reverse = (this.reverse == 'desc' ? 'asc' : 'desc');

            // A little bit dirty but quick...
            // toggle class wouldn't work on the font awesome element
            if (this.reverse == 'asc') {
                icon.removeClass('fa-chevron-down');
                icon.addClass('fa-chevron-up');
            } else {
                icon.removeClass('fa-chevron-up');
                icon.addClass('fa-chevron-down');
            }
        }
    },
    computed: {

        /**
         * Due to the removal of filters, using a computed
         * function that returns the data based on ordering
         * using the loadash library and the component properties
         * for the column to sort and direction
         */
        orderedBookings: function () {
            return _.orderBy(this.bookings, this.field, this.reverse);
        }
    }
})