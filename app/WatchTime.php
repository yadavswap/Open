<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WatchTime extends Model
{
    //
    protected $table = "watch_times";

    protected $fillable = ['ends_at_date','ends_at_time'];
}
