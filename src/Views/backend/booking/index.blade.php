@extends('backend.layout.default')
@section('content')
    <div class="page-wrap">
        <div class="mdl-grid">
            <div class="mdl-cell--6-col">
                {!! Form::open(['method' => 'GET', 'url' => "/backend/booking/date"]) !!}
                <div class="mdl-grid">
                    <div class="mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input input-calendar" name="date" type="text" id="date">
                            <label class="mdl-textfield__label" for="date">Select date...</label>
                        </div>
                    </div>
                    <div class="mdl-cell--6-col">
                        <button type="submit" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--mini-fab" id="filter-date">
                            <i class="material-icons">event</i>
                        </button>
                        <div class="mdl-tooltip" data-mdl-for="filter-date">
                            View Active Bookings by Date
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="mdl-cell--6-col">
                <div class="section section--right">
                    <p>
                        <!-- <span class="body">New Booking</span> -->
                        <a href="{!! route('newBooking') !!}" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored" id="new-booking-button">
                            <i class="material-icons">add</i>
                        </a>
                    </p>
                    <div class="mdl-tooltip" data-mdl-for="new-booking-button">
                        Create new booking
                    </div>
                </div>
            </div>
        </div>
        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width" id="bookings">
            <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">Name</th>
                    <th>Size</th>
                    <th class="mdl-data-table__cell--non-numeric cursor" v-on:click="sortColumns($event, 'date')"><i class="fa fa-chevron-down"></i> Date</th>
                    <th class="mdl-data-table__cell--non-numeric">Time</th>
                    <th class="mdl-data-table__cell--non-numeric cursor" v-on:click="sortColumns($event, 'email')"><i class="fa fa-chevron-down"></i> Email</th>
                    <th class="mdl-data-table__cell--non-numeric">Telephone</th>
                    <th class="mdl-data-table__cell--non-numeric cursor" v-on:click="sortColumns($event, 'status')"><i class="fa fa-chevron-down"></i> Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="booking in orderedBookings" v-cloak>
                    <td class="mdl-data-table__cell--non-numeric">{{ booking.name }}</td>
                    <td>{{ booking.size }}</td>
                    <td class="mdl-data-table__cell--non-numeric">{{ booking.date }}</td>
                    <td class="mdl-data-table__cell--non-numeric">{{ booking.time }}</td>
                    <td class="mdl-data-table__cell--non-numeric">{{ booking.email }}</td>
                    <td class="mdl-data-table__cell--non-numeric">{{ booking.telephone }}</td>
                    <td class="mdl-data-table__cell--non-numeric">
                        <span class="mdl-chip mdl-chip--contact" v-if="booking.status == 'pending'">
                            <span class="mdl-chip__contact mdl-color--pink mdl-color-text--white">
                                <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                            </span>
                            <span class="mdl-chip__text">Pending</span>
                        </span>

                        <span class="mdl-chip mdl-chip--contact" v-if="booking.status == 'confirmed'">
                            <span class="mdl-chip__contact mdl-color--green mdl-color-text--white">
                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                            </span>
                            <span class="mdl-chip__text">Confirmed</span>
                        </span>

                        <span class="mdl-chip mdl-chip--contact" v-if="booking.status == 'cancelled'">
                            <span class="mdl-chip__contact mdl-color--red mdl-color-text--white">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </span>
                            <span class="mdl-chip__text">Cancelled</span>
                        </span>

                        <span class="mdl-chip mdl-chip--contact" v-if="booking.status == 'rejected'">
                            <span class="mdl-chip__contact mdl-color--red mdl-color-text--white">
                                <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                            </span>
                            <span class="mdl-chip__text">Rejected</span>
                        </span>

                        <span class="mdl-chip mdl-chip--contact" v-if="booking.status == 'completed'">
                            <span class="mdl-chip__contact mdl-color--grey mdl-color-text--white">
                                <i class="fa fa-check"></i>
                            </span>
                            <span class="mdl-chip__text">Completed</span>
                        </span>

                        <!-- <span v-if="booking.status != 'Pending'">{{ booking.status }}</span> -->
                    </td>
                    <td>
                        <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect mdl-button--colored" v-on:click="viewBooking($event, booking)">
                          <i class="material-icons">settings</i>
                        </button>

                        <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect margin-left-sm" id="show-dialog" v-on:click="deleteBooking($event, booking)">
                          <i class="material-icons">delete</i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <script type="text/javascript">

        var viewRoute = "{!! route('viewBooking', ['id' => '']) !!}";
    </script>
@stop