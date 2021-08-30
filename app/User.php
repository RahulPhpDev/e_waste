<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\{Role, Scrap, Zone, UserAddress,Image};
use App\Traits\TranslatorTrait;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, TranslatorTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password','role_id', 'active', 'phone'
    // ];
    protected $guarded = [];

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

    public $translatable = ['name'];

    public $with = ['role'];


    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    public function zone()
    {
        return $this->belongsToMany(Zone::class);
    }

     public function firstZone()
    {
        return $this->zone()->first();
    }

    public function address()
    {
        return $this->hasOne(UserAddress::class);
    }

    public function scrapOrder()
    {
        return $this->hasMany(Scrap::class);
    }


    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
