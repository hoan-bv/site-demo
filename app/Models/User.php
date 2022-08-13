<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property int      $id
 * @property string   $name
 * @property string   $email
 * @property string   $email_verified_at
 * @property string   $password
 * @property int      $lang_id
 * @property string   $remember_token
 * @property string   $created_at
 * @property string   $updated_at
 * @property Language $language
 *
 */
class User extends Authenticatable implements JWTSubject {

    use HasApiTokens, HasFactory, Notifiable;

    const RULES = [
        'email'    => 'required|email|unique:users|max:255',
        'name'     => 'required|max:255',
        'password' => 'required|confirmed|min:6|max:255',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    public function language() {
        //        echo '<pre>';
        //        print_r(444444);
        //        die;
        return $this->hasOne(Language::class, 'id', 'lang_id');
    }
}
