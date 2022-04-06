<?php

namespace App\Forms\Users;

use App\Forms\BaseForm;
use Illuminate\Validation\Rule;

/**
 * @property string $email
 * @property string $name
 * @property string $firstname
 * @property string $lastname
 * @property string $password
 * @property string $address
 * @property string $description
 * @property string $password_confirmation
 * @property string $device_token
 * @property string $image
 * @property string $signup_otp
 * @property string $pin
 * @property int $user_type
 * @property boolean $is_verified
 *
 *
 */
class RegisterForm extends BaseForm
{

    /** @var $email */
    public $email;

    /** @var $name */
    public $name;

    /** @var $firstname */
    public $firstname;

    /** @var $lastname */
    public $lastname;


    /** @var $device_token */
    public $device_token;

    /** @var $user_type */
    public $user_type;

    /** @var $description */
    public $description;

    /** @var $address */
    public $address;

    /** @var $image */
    public $image;

    /** @var $mobile */
    public $mobile;

    /** @var $gender */
    public $gender;

    /** @var $date_of_birth */
    public $date_of_birth;

    /** @var $password */
    public $password;

    /** @var $password_confirmation */
    public $password_confirmation;

    /**
     * Convert Instance to Array
     * @return array
     */
    public function toArray()
    {
        return [
            '$this->firstname' => $this->firstname,
            '$this->lastname' => $this->lastname,
            '$this->name' => $this->name,
            'email' => $this->email,
            'device_token' => $this->device_token,
            'address' => $this->address,
            'description' => $this->description,
            'date_of_birth' => $this->date_of_birth,
            'image'         => $this->image,
            'gender' => $this->gender,
            'mobile' => $this->mobile,
            'user_type' => $this->user_type,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'email|required|unique:users',
            'name' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'device_token' => 'required',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ];

    }
}
