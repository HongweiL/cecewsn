<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'affiliation', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getRole() {
        $users = DB::select("select role from users where id = ?", [Auth::id()]);
        foreach ($users as $user) {
            return $user -> role;
        }
    }

    /**
     * Check if user is approved for accessing website
     *
     * @return bool
     */
    public static function isApproved() {
        $users = DB::select("select role from users where id = ?", [Auth::id()]);
        return $users[0] -> role != 0;
    }
}
