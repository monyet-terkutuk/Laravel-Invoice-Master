<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Check if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->is_admin === 1;
    }

    /**
     * Check if the user is part of the finance department.
     *
     * @return bool
     */
    public function isKeuangan()
    {
        return $this->is_keuangan === 1;
    }

    /**
     * Check if the user is a director.
     *
     * @return bool
     */
    public function isDirektur()
    {
        return $this->is_direktur === 1;
    }
}
