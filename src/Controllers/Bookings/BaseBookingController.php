<?php

namespace Twentysix\Booker\Controllers\Bookings;

use Twentysix\Booker\Models\Booking;
use Twentysix\Booker\Models\BookingSettings;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;
use Twentysix\Booker\Traits\BookingTrait;
use Twentysix\Booker\Transformers\BookingTransformer;

class BaseBookingController extends Controller
{
    use BookingTrait;

    const STATUS_PENDING = 'pending';

    const STATUS_CONFIRMED = 'confirmed';

    const STATUS_REJECTED = 'rejected';

    const STATUS_CANCELLED = 'cancelled';

    const STATUS_COMPLETED = 'completed';

    /**
     * Valid Updateable fields
     *
     * @todo  Move into repository with crud methods
     *
     * @var array
     */
    protected $updateableFields = [
        'email',
        'name',
        'date',
        'time',
        'status',
        'telephone',
    ];

    public function __construct(Request $request, BookingTransformer $transformer)
    {
        $this->request = $request;
        $this->setTransformer($transformer);
    }
}
