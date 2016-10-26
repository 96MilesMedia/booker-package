/**
 * Component: Back Button
 *
 * Component to go to previous page
 */
new Vue({
    el: '#goBack',
    beforeCreate: function () {

    },
    methods: {

        goBack: function (event) {
            parent.history.back();
            return false;

            event.preventDefault();
        }
    }
})