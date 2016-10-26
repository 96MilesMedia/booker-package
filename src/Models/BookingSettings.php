<?php

namespace Twentysix\Booker\Models;

use Illuminate\Database\Eloquent\Model;

class BookingSettings extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'time_allocation', 'email', 'seats',
    ];

}
