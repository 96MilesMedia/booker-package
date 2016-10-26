<?php

namespace Twentysix\Booker\Controllers\Bookings;

use Twentysix\Booker\Models\Booking;
use Twentysix\Booker\Models\BookingSettings;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twentysix\Booker\Transformers\BookingSettingsTransformer;

class BookingSettingsController extends Controller
{
    public function __construct(Request $request, BookingSettingsTransformer $transformer)
    {
        $this->request = $request;
        $this->setTransformer($transformer);
    }

    /**
     * Retrieve settings - always assigned to the first row
     *
     * @return Response
     */
    public function get()
    {
        $settings = BookingSettings::find(1);

        $data = $this->transform($settings);

        return $this->respond($data, 202);
    }
}
