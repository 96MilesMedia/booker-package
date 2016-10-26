@extends('backend.layout.default')
@section('content')
    {!! Form::open(['url' => '/backend/booking']) !!}
    <div class="page-wrap" id="bookingForm">
        @include('backend.booking.booking-form')

        <div class="section section--right">
            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
              Create Booking
            </button>
        </div>
    </div>
    {!! Form::close() !!}

    <script type="text/javascript">
        var booking = {data: {
            name : '',
            email : '',
            date : '',
            time : '',
            size : '',
            status : '',
            telephone : '',
            created_at : '',
            timeActive: false
        }};
    </script>
@stop