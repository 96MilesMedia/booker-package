@extends('backend.layout.default')
@section('content')
    <div class="page-wrap" id="bookingsManage">
        <div v-if="bookings.length == 0" v-cloak>
            <h3 class="primary-title">No Bookings Found</h3>
            <p class="body">Looks like the calander is clear for this date so far.</p>
        </div>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--4-col" v-for="booking in bookings" v-cloak>
                <div class="card-wrap">

                    <div class="card-event mdl-card mdl-shadow--2dp"
                        v-bind:class="{ 'mdl-card--complete': (booking.status == 'completed') }">
                        <div class="mdl-card__title mdl-card--expand">
                            <h4>
                                {{ booking.name }} ({{ booking.size }})<br>
                                {{ booking.date }}<br>
                                {{ booking.time }}
                            </h4>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" v-on:click="viewBooking($event, booking)">
                            View Details
                            </a>
                            <div class="mdl-layout-spacer"></div>
                            <i class="material-icons">event</i>
                        </div>

                        <div class="mdl-card__actions mdl-card__actions--alt mdl-card--border" v-show="booking.status != 'completed'">
                            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" v-on:click="completeBooking($event, booking)">
                            Party Arrived?
                            </a>
                            <div class="mdl-layout-spacer"></div>
                            <i class="material-icons">accessibility</i>
                        </div>

                        <div class="mdl-card__actions mdl-card--border" v-show="booking.status == 'completed'">
                            <span class="mdl-chip mdl-chip--contact">
                                <span class="mdl-chip__contact mdl-color--light-green mdl-color-text--white"><i class="fa fa-check"></i></span>
                                <span class="mdl-chip__text">Booking Arrived</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script type="text/javascript">
        var viewRoute = "{!! route('viewBooking', ['id' => '']) !!}";
        var bookingDate = "{!! $date !!}";
    </script>
@stop