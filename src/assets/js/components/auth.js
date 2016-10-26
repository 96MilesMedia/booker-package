/**
 * Component: Auth
 *
 * Handles any login or auth related functionality
 */
new Vue({
    el: '#auth',
    data: {
        email: '',
        password: '',
        error: false,
        errorMessage: '',
        submitted: false
    },
    beforeCreate: function () {

    },
    methods: {
        login: function (event) {

            var self = this;

            this.submitted = true;

            this.$http.post('/api/admin/auth/login',
                {
                    'email': self.email,
                    'password': self.password,
                })
                .then(function (success) {

                    var user = success.body.data;
                    localStorage.setItem('USER_DETAILS', JSON.stringify(user));

                    window.location = "/backend/dashboard";

                    this.submitted = false;

                }, function (error) {
                    console.log(error);
                    this.error = true;
                    this.errorMessage = (error.body.reason_phrase ? error.body.reason_phrase : "Unable to login with those credentials");
                    this.submitted = false;
                });

            event.preventDefault();
        },

        logout: function (event) {
            console.log("logout")
            this.$http.post('/api/admin/auth/logout', {})
                .then(function (success) {

                    window.location = "/backend/login";

                    this.submitted = false;

                }, function (error) {

                });

            event.preventDefault();
        }
    }
})