<?php

namespace App\Forms\Places;
/**
 * @property string $name
 * @property string $image_url
 * @property string $old_image_url
 * @property int $category_id
  * @property int $district_id
 */
class UpdatePlaceForm extends \App\Forms\BaseForm
{
    /* @var $name */
    public $name;

    /* @var $description */
    public $description;

    /* @var $address */
    public $address;

    /* @var $image_url */
    public $image_url;

    /* @var $old_image_url */
    public $old_image_url;

    /* @var $category_id */
    public $category_id;

    /* @var $district_id */
    public $district_id;

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'description' => $this->description,
            'image_url' => $this->image_url,
            'old_image_url' => $this->old_image_url,
            'category_id' => $this->category_id,
             'district_id' => $this->district_id,

        ];
    }

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [


        ];
    }
}
