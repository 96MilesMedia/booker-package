@extends('backend.layout.default')
@section('content')

    {!! Form::open(['method' => 'PUT', 'url' => "/backend/booking/".$booking['data']['uid']]) !!}
    <div class="page-wrap" id="bookingForm">
        <div class="mdl-grid">
            <div class="mdl-cell--9-col">
                @include('backend.booking.booking-form')
                <div class="section section--right">
                    <button type="submit"
                            name="update"
                            value="update"
                            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect"
                            v-cloak v-if="status != 'cancelled' && status != 'rejected'">
                        Update Details
                    </button>
                </div>
            </div>
            <div class="mdl-cell--3-col">
                <div class="section section--padded-sides">
                    <div v-if="status == 'cancelled' || status == 'rejected'" v-cloak>
                        <p class="body">Booking has either been cancelled or rejected. There are no more actions that can be assigned to this booking now.</p>
                    </div>
                    <div v-cloak v-if="status != 'cancelled' && status != 'rejected'">
                        <button type="submit"
                                name="confirm-booking"
                                value="confirm"
                                class="mdl-button
                                       mdl-js-button
                                       mdl-button--raised
                                       mdl-button--colored--positive
                                       mdl-js-ripple-effect
                                       margin-bottom-sm
                                       full-width"
                                v-if="status != 'rejected' && status != 'confirmed'">
                            <i class="material-icons">assignment_turned_in</i> Confirm Booking
                        </button>

                        <button type="submit"
                                name="reject-booking"
                                value="reject"
                                class="mdl-button
                                       mdl-js-button
                                       mdl-button--raised
                                       mdl-button--colored
                                       mdl-js-ripple-effect
                                       margin-bottom-sm
                                       full-width"
                                 v-if="status != 'rejected' && status != 'confirmed'">
                          <i class="material-icons">assignment_late</i> Reject Booking
                        </button>

                        <button type="submit"
                                name="cancel-booking"
                                value="cancel"
                                class="mdl-button
                                      mdl-js-button
                                      mdl-button--raised
                                      mdl-button--accent
                                      mdl-js-ripple-effect
                                      margin-bottom-sm
                                      full-width">
                            <i class="material-icons">highlight_off</i> Cancel Booking
                        </button>
                    </div>

                    <!-- Confirmation Chip -->
                    <span v-cloak class="mdl-chip mdl-chip--contact" v-if="status == 'pending'">
                        <span class="mdl-chip__contact mdl-color--pink mdl-color-text--white">
                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                        </span>
                        <span class="mdl-chip__text">Booking is Pending Action</span>
                    </span>

                    <p v-cloak v-if="status == 'pending'" class="body margin-top-md">Booking is pending therefore it must have an action above applied to it.</p>

                    <span v-cloak class="mdl-chip mdl-chip--contact" v-if="status == 'confirmed'">
                        <span class="mdl-chip__contact mdl-color--green mdl-color-text--white">
                            <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                        </span>
                        <span class="mdl-chip__text">Booking has been Confirmed</span>
                    </span>

                    <span v-cloak class="mdl-chip mdl-chip--contact" v-if="status == 'cancelled'">
                        <span class="mdl-chip__contact mdl-color--red mdl-color-text--white">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </span>
                        <span class="mdl-chip__text">Booking has been Cancelled</span>
                    </span>

                    <span v-cloak class="mdl-chip mdl-chip--contact" v-if="status == 'rejected'">
                        <span class="mdl-chip__contact mdl-color--red mdl-color-text--white">
                            <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                        </span>
                        <span class="mdl-chip__text">Booking has been Rejected</span>
                    </span>

                    <span v-cloak class="mdl-chip mdl-chip--contact" v-if="status == 'completed'">
                        <span class="mdl-chip__contact mdl-color--grey mdl-color-text--white">
                            <i class="fa fa-check"></i>
                        </span>
                        <span class="mdl-chip__text">Booking Completed</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    <script type="text/javascript">
        var booking = {!! json_encode($booking) !!};
    </script>
@stop