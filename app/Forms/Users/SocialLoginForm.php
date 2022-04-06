<?php

namespace App\Forms\Users;

use App\Forms\BaseForm;
use Illuminate\Validation\Rule;

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
 * @property boolean $is_verified
 * @property string $city
 * @property string $country
 * @property string $social_token
 *
 */
class SocialLoginForm extends BaseForm {

    /** @var $email */
    public $email;

    /** @var $firstname */
    public $firstname;

    /** @var $lastname */
    public $lastname;

    /** @var $password */
    public $password;

    /** @var $password_confirmation */
    public $password_confirmation;

    /** @var $device_token */
    public $device_token;

    /** @var $mobile */
    public $mobile;

    /** @var $image */
    public $image;

    /** @var $street */
    public $street;

    /** @var $city */
    public $city;

    /** @var $country */
    public $country;

    /** @var $zip */
    public $zip;

    /** @var $d_o_b */
    public $d_o_b;

    /** @var $social_token */
    public $social_token;


    /**
     * Convert Instance to Array
     * @return array
     */
    public function toArray(): array
    {
        return [
            'firstname'             => $this->firstname,
            'lastname'              => $this->lastname,
            'email'                 => $this->email,
            'password'              => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'device_token'          => $this->device_token,
            'mobile'                => $this->mobile,
            'image'                 => $this->image,
            'city'                  => $this->city,
            'country'               => $this->country,
            'zip'                   => $this->zip,
            'street'                => $this->street,
            'd_o_b'                 => $this->d_o_b,
            'social_token'          => $this->social_token,

        ];
    }

    /**
     * @return array
     */
    public function rules() {
        return [
            'social_token'                  => 'required',
            'd_o_b'                         => 'date|before:-18 years',
        ];
    }
}
