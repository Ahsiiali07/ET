<?php

namespace App\Forms\Users;

use App\Forms\BaseForm;
use Illuminate\Validation\Rule;

/**
 * @property string $firstname
 * @property string $lastname
 * @property string $device_token
 * @property string $email
 * @property string $mobile
 * @property string $address
 * @property string $image
 * @property string $street
 * @property string $zip
 * @property string $d_o_b
 * @property string $city
 * @property string $country
 *
 */
class UpdateForm extends BaseForm {

    /** @var $firstname */
    public $firstname;

    /** @var $email */
    public $email;

    /** @var $lastname */
    public $lastname;

    /** @var $device_token */
    public $device_token;

    /** @var $mobile */
    public $mobile;

    /** @var $address */
    public $address;

    /** @var $image */
    public $image;

    /** @var $old_image */
    public $old_image;

    /** @var $street */
    public $street;

    /** @var $zip */
    public $zip;

    /** @var $d_o_b */
    public $d_o_b;

    /** @var $city */
    public $city;

    /** @var $country */
    public $country;


    /**
     * Convert Instance to Array
     * @return array
     */
    public function toArray() {
        return [
            'firstname'             => $this->firstname,
            'email'                 => $this->email,
            'lastname'              => $this->lastname,
            'device_token'          => $this->device_token,
            'mobile'                => $this->mobile,
            'address'               => $this->address,
            'image'                 => $this->image,
            'street'                => $this->street,
            'zip'                   => $this->zip,
            'd_o_b'                 => $this->d_o_b,
            'city'                  => $this->city,
            'country'               => $this->country,
        ];
    }

    /**
     * @return array
     */
    public function rules() {
        return [
        ];

    }
}
