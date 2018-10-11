<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yadahan\AuthenticationLog\AuthenticationLogable;
use App\Patient;



class User extends Authenticatable
{

    use LaratrustUserTrait;
    use Notifiable;
    use SoftDeletes;
    use AuthenticationLogable;




/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $dates = ['deleted_at'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','pic',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function hospital()
    {
        return $this->hasOne('App\Hospital');
    }

}
