<?php

namespace Twentysix\Booker\Transformers;

use App\Core\Contracts\TransformerInterface;
use Twentysix\Booker\Models\BookingSettings;
use League\Fractal\TransformerAbstract;

class BookingSettingsTransformer extends TransformerAbstract implements TransformerInterface
{
    public function transform($settings)
    {
        return [
            'seats' => $settings->seats,
            'time_allocation' => $settings->time_allocation,
            'opening_time' => $settings->opening_time,
            'closing_time' => $settings->closing_time,
            'email' => $settings->email,
            'updated_at' => $settings->updated_at,
        ];
    }
}
