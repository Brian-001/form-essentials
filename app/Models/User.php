<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

// use Sushi\Sushi;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    // use \Sushi\Sushi;


    // protected $guarded = [];

    // protected $rows = [
    //     [
    //         'id' => 4,
    //         'email' => 'karanjabrian001@gmail.com',
    //         'password' => "",
    //         'username' => 'Brian Karanja',
    //         'bio' => '',
    //         'receives_email' => false,
    //         'receives_updates' => '',
    //         'receives_offers' => '',
    //         'country' => 'Kenya'
    //     ]
    // ];

   protected $cast = [
    'receive_emails' => 'boolean',
    'receive_updates' => 'boolean',
    'receive_offers' => 'boolean',
    'country' => 'string',
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
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function stores()
    {
        return $this->hasMany(Store::class);
    }

}
