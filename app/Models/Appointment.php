<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        "user_id",
        "name",
        "email",
        "phone",
        "preferred_date",
        "preferred_time",
        "reason",
    ];
}
