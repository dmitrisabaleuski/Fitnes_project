<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Usersdata extends Model
{
    use Notifiable;

    protected $fillable = [
        'id', 'user_id', 'role_taxonomy', 'profile_image', 'contacts', 'series_access',
    ];
}
