<?php

namespace App\Forms\Users;

use App\Forms\BaseForm;

/**
 * @property bool $status
 *
 */
class UpdateUserStatusForm extends BaseForm {

    /** @var $status */
    public $status;


    /**
     * Convert Instance to Array
     * @return array
     */
    public function toArray() {
        return [
            'status'             => $this->status,
        ];
    }

    /**
     * @return array
     */
    public function rules() {
        return [
            'status' => 'required'
        ];

    }
}
