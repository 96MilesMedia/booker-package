<?php

namespace Twentysix\Booker\Traits;

use Twentysix\Booker\Models\Booking;
use Webpatser\Uuid\Uuid;

trait BookingTrait {

    public function createBooking()
    {
        $booking = new Booking;

        $request = $this->request->all();

        $booking->uid = Uuid::generate();
        $booking->email = $request['email'];
        $booking->name = $request['name'];
        $booking->date = $request['date'];
        $booking->time = $request['time'];
        $booking->size = $request['size'];
        $booking->telephone = $request['telephone'];
        $booking->status = self::STATUS_PENDING;

        if ($booking->save()) {
            return $booking;
        }

        return false;
    }

    public function updateBooking($id)
    {
        $request = $this->request->all();

        $booking = Booking::where('uid', $id)->first();

        foreach ($request as $key => $value) {
            // Check fields are valid updatable fields
            if (in_array($key, $this->updateableFields)) {
                $booking->{$key} = $value;
            }
        }

        // Backend picking up manual submits for the time being
        if (isset($request['confirm-booking'])) {
            $booking->status = self::STATUS_CONFIRMED;
        }

        if (isset($request['cancel-booking'])) {
            $booking->status = self::STATUS_CANCELLED;
        }

        if (isset($request['reject-booking'])) {
            $booking->status = self::STATUS_REJECTED;
        }

        return $booking->save();
    }

}