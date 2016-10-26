<?php

namespace Twentysix\Booker\Controllers\Admin\Bookings;

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

    public function view()
    {
        $this->addScript('components/booking-settings.js');

        $this->setPageTitle("Booking Settings");

        return $this->loadViewWithScripts('backend.booking.settings');
    }

    public function update()
    {
        $request = $this->request->all();

        $settings = BookingSettings::firstOrNew(['id' => 1]);

        $settings->time_allocation = $request['time_allocation'];
        $settings->opening_time = $request['opening_time'];
        $settings->closing_time = $request['closing_time'];
        $settings->seats = $request['seats'];
        $settings->email = $request['email'];

        $settings->save();

        return $this->respondUpdated("Booking Settings successfully updated");
    }
}
