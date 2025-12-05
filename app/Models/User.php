<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_user';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'section_id',
        'usr',
        'pswd',
        'email',
        'no_hp',
        'kode_user',
        'is_active',
        'level',
        'is_user_computer',
        'image_sign'
    ];

    public function getAuthPassword()
    {
        return $this->pswd;
    }
}
