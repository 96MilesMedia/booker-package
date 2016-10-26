@extends('backend.layout.default')
@section('content')
    {!! Form::open(['url' => '/backend/booking/settings']) !!}
    <div class="page-wrap" id="bookingSettings">
        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width">
            <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">Adjust Booking Settings</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">Availability per time slot</td>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input" name="seats" type="text" id="seats" pattern="-?[0-9]*(\.[0-9]+)?" v-model="settings.seats">
                            <label class="mdl-textfield__label" for="seats"></label>
                            <span class="mdl-textfield__error">Input is not a number!</span>

                            <!-- Seats Tooltip -->
                            <div class="mdl-tooltip" data-mdl-for="seats">
                                Available no. of seats per time slot
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">Opening Time</td>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input time-general" name="opening_time" type="text" id="opening_time" v-model="settings.opening_time">
                            <label class="mdl-textfield__label" for="time"></label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">Closing Time</td>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input time-general" name="closing_time" type="text" id="closing_time" v-model="settings.closing_time">
                            <label class="mdl-textfield__label" for="time"></label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">Time Allocation</td>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input" name="time_allocation" type="text" id="time" pattern="-?[0-9]*(\.[0-9]+)?" v-model="settings.time_allocation">
                            <label class="mdl-textfield__label" for="time"></label>
                            <span class="mdl-textfield__error">Input is not a number!</span>

                            <!-- Time Allocation Tooltip -->
                            <div class="mdl-tooltip" data-mdl-for="time">
                                Intervals between bookings, e.g 30
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">Email Address</td>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input" name="email" type="text" id="email" v-model="settings.email">
                            <label class="mdl-textfield__label" for="email"></label>

                            <!-- Email Address Tooltip -->
                            <div class="mdl-tooltip" data-mdl-for="email">
                                Email to notify bookings
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="section section--right">
            <div class="mdl-spinner mdl-spinner--submit-form mdl-js-spinner is-active" v-show="formSubmitted" v-cloak></div>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"
                    :disabled="formSubmitted"
                    v-on:click="updateSettings($event)">
                Save Settings
            </button>
        </div>
    </div>
    {!! Form::close() !!}
@stop