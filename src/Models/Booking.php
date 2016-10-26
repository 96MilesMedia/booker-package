<?php

namespace Twentysix\Booker\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function setDateAttribute($value)
    {
        return $this->attributes['date'] = date('Y-m-d', strtotime($value));
    }

    public function setStatusAttribute($value)
    {
        return $this->attributes['status'] = strtolower($value);
    }

    public function getDateAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
}
