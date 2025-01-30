<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Town extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'city',
        'state_id',
        'state_name',
        'county_name',
    ];
}
