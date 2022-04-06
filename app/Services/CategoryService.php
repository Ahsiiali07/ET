<?php

namespace App\Services;

use App\Helpers\GeneralHelper;
use App\Models\Category;
use App\Forms\IForm;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

/**
 * Class CategoryService
 * @package App\Services
 */
class CategoryService extends BaseService {

    /**
     * CategoryService constructor.
     */
    public function __construct() {
        $this->model = new Category();

        parent::__construct();
    }

    /**
     * @param null $paginate
     *
     * @return mixed
     */
    public function getAll( $paginate = null ) {
        if ( $paginate ) {
            return $this->model->paginate( $paginate );
        }

        return $this->model->get();
    }

    /**
     * @param IForm $form
     *
     * @return Category
     * @throws ValidationException
     */
    public function store( IForm $form ): Category
    {
        $form->validate();
        if ( $form->image_url ) {
            $form->image_url = GeneralHelper::uploadImageManual( $form->image_url, 'images/category' );
        }
        $category = new Category();
        $form->loadToModel( $category );
        $category->save();

        return $category;
    }

    /**
     * @param IForm $form
     * @param  $categoryId
     *
     * @return mixed
     * @throws ValidationException
     */
    public function update( IForm $form, $categoryId ) {
        $form->validate();
        if ( $form->image_url ) {
            $form->image_url = GeneralHelper::uploadImageManual( $form->image_url, 'images/category', ( ! $form->old_image_url ) ?: true, $form->old_image_url ?? null );
        } else {
            $form->image_url = $form->old_image_url;
        }
        $category = $this->findById( $categoryId );
        $form->loadToModel( $category );
        $category->update();

        return $category;
    }

    /**
     * @param $data
     * @param $categoryId
     *
     * @return mixed
     */
    public function updateDetails( $data, $categoryId ) {
        $category = $this->findById( $categoryId );
        $category->update( $data );

        return $category;
    }

    /**
     * @return array
     */
    public static function allWithIdAndName(): array
    {
        return Category::all()->pluck( 'name', 'id' )->all();
    }
}
