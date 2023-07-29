<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'users';
    protected $guarded = false;

    const ROLE_ADMIN = 0;
    const ROLE_MODERATOR = 1;
    const ROLE_USER = 2;

    public static function isAdmin()
    {
        return Auth::user()->role == self::ROLE_ADMIN;
    }

    public static function isModerator()
    {
        return Auth::user()->role == self::ROLE_MODERATOR;
    }

    public static function isUser()
    {
        return Auth::user()->role == self::ROLE_USER;
    }

    public static function canEditPost($post_author_id)
    {
        return Auth::user()->id == $post_author_id ||
            Auth::user()->isAdmin() ||
            Auth::user()->isModerator();
    }

    public static function getRoles()
    {
        return [
            self::ROLE_ADMIN => 'Админ',
            self::ROLE_MODERATOR => 'Модератор',
            self::ROLE_USER => 'Юзер',
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
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
}
