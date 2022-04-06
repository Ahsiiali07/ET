<?php

namespace App\Forms\Category;
use App\Forms\BaseForm;/**
 * @property string $name
 * @property string $image_url
 * @property string $old_image_url
 */
class UpdateCategoryForm extends BaseForm
{
    /* @var $name */
    public $name;

    /* @var $description */
    public $description;

    /* @var $image_url */
    public $image_url;

    /* @var $old_image_url */
    public $old_image_url;



    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'image_url' => $this->image_url,
            'old_image_url' => $this->old_image_url,

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
