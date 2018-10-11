<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use SoftDeletes;

    /**
     * Soft Delete Column
     */
    protected $dates = ['deleted_at'];
}
