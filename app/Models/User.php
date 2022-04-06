<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Illuminate\Database\Eloquent\SoftDeletes;
use willvincent\Rateable\Rateable;

/**
 * @property string $email
 * @property string $firstname
 * @property string $lastname
 * @property string $password
 * @property string $password_confirmation
 * @property string $device_token
 * @property string $signup_otp
 * @property string $pin
 * @property int $user_type
 * @property string $mobile
 * @property string $address
 * @property string $image
 * @property int $is_verified
 * @property int $is_approved
 * @property string $city
 * @property string $country
 * @property int $status
 *
 */
class User extends Authenticatable {
    use HasApiTokens, Notifiable, ModelHelper, Billable;
    use SoftDeletes, Rateable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'name',
        'firstname',
        'lastname',
        'mobile',
        'description',
        'address',
        'user_type',
        'image',
        'device_token',
        'is_verified',
        'is_approved',
        'date_of_birth',
        'gender',
        'status',
        'social_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pin',
        'password',
        'signup_otp',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'is_verified' => 'boolean',
        'status'      => 'boolean',
    ];


    /**
     * @var bool|mixed
     */
    private $is_approved;
    /**
     * @var mixed
     */
    private $id;


    /**
     * @return HasMany
     */
    public function favorite(): HasMany
    {
        return $this->hasMany( Favorite::class );
    }
    /**
     * @return HasMany
     */
    public function intrested(): HasMany
    {
        return $this->hasMany( Intrested::class );
    }

    /**
     * @return HasMany
     */
    public function eventfeedback(): HasMany
    {
        return $this->hasMany( EventFeedback::class );
    }
    /**
     * @return HasMany
     */
    /**
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(CompanyImage::class);

    }
    /**
     * @return mixed
     */
    public function getRatingAttribute()
    {
        return $this->averageRating();
    }

    /**
     * @return HasMany
     */
    public function joinEvent(): HasMany
    {
        return $this->hasMany(JoinEvent::class);

    }

    /**
     * @return BelongsToMany
     */
    public function Event(): BelongsToMany
    {
        return $this->belongsToMany(Event::class);

    }


//    public function visited()
//    {
//        return $this->hasMany(PlaceVisited::class);
//
//    }


//    public function place()
//    {
//        return $this->hasMany(Place::class);
//
//    }

}
