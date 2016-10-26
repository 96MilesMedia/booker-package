/**
 * Component: User Settings
 *
 * Vue Component updates the user settings
 */
var bookingSettings = new Vue({
    el: '#userSettings',
    data: {
        user: {},
        formSubmitted: false
    },
    beforeCreate: function () {
        this.user = localStorage.getItem('USER_DETAILS');
    },
    methods: {

        /**
         * Update the User settings
         *
         * @param  {Object} event
         */
        updateSettings: function (event) {

            event.preventDefault();

            this.formSubmitted = true;
            self = this;

            console.log("update settings");

            this.$http.put('/api/admin/auth/settings', this.user)
                .then(function (success) {

                    var data = success.body.data;

                    self.formSubmitted = false;

                    // Reset Local Storage
                    localStorage.setItem('USER_DETAILS', JSON.stringify(self.user));

                    // Notify snackbar of success
                    this.notify("User Settings Updated");
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