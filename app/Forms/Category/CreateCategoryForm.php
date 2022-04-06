<?php

namespace App\Forms\Category;

/**
 * @property string $name
 * @property string $image_url

 */
class CreateCategoryForm extends \App\Forms\BaseForm
{

    /* @var $name */
    public $name;

    /* @var $description */
    public $description;

    /* @var $image_url */
    public $image_url;




    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'image_url' => $this->image_url,

        ];
    }

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'image_url' => 'required',
            'description' => 'required',
        ];
    }
}
