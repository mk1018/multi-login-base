<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_first',
        'name_last',
        'name_first_other',
        'name_last_other',
        'country_code',
        'zip',
        'prefectures',
        'address_1',
        'address_2',
        'address_3',
        'mobile_numer_country_code',
        'mobile_number',
        'landline_number',
        'birthday',
        'email',
        'password',
        'qr_token',
        'qr_issuedated_at',
        'expired_at',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
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
     * JWT の subject claim となる識別子を取得する
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * キーバリュー値を返します, JWTに追加される custom claims を含む
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
