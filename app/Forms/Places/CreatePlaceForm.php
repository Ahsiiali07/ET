<?php

namespace App\Forms\Places;

/**
 * @property string $name
 * @property string $image_url
 * @property int $category_id
 * @property int $district_id
 */
class CreatePlaceForm extends \App\Forms\BaseForm
{

    /* @var $name */
    public $name;

    /* @var $description */
    public $description;

    /* @var $address */
    public $address;

    /* @var $image_url */
    public $image_url;


    /* @var $district_id */
    public $district_id;


    /* @var $category_id */
    public $category_id;

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'description' => $this->description,
            'image_url' => $this->image_url,
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
            'name' => 'required',
            'address' => 'required',
            'image_url' => 'required',
            'description' => 'required',
        ];
    }
}
