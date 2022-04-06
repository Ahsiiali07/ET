<?php

namespace App\Services;

use App\Helpers\GeneralHelper;
use App\Models\Category;
use App\Models\District;
use App\Models\Place;
use App\Forms\IForm;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

/**
 * Class CategoryService
 * @package App\Services
 */
/**
 * Class DistrictService
 * @package App\Services
 */

class PlacesService extends BaseService {

    /**
     * CategoryService constructor.
     */

    /**
     * DistrictService constructor.
     */

    public function __construct() {
        $this->model = new Place();

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
     * @return Place
     * @throws ValidationException
     */
    public function store( IForm $form ): Place
    {
        $form->validate();
        if ( $form->image_url ) {
            $form->image_url = GeneralHelper::uploadImageManual( $form->image_url, 'images/place' );
        }
        $place = new Place();
        $form->loadToModel( $place );
        $place->save();

        return $place;
    }

    /**
     * @param IForm $form
     * @param  $placeId
     *
     * @return mixed
     * @throws ValidationException
     */
    public function update( IForm $form, $placeId ) {
        $form->validate();
        if ( $form->image_url ) {
            $form->image_url = GeneralHelper::uploadImageManual( $form->image_url, 'images/category', ( ! $form->old_image_url ) ?: true, $form->old_image_url ?? null );
        } else {
            $form->image_url = $form->old_image_url;
        }
        $place = $this->findById( $placeId );
        $form->loadToModel( $place );
        $place->update();

        return $place;
    }

    /**
     * @param $data
     * @param $placeId
     *
     * @return mixed
     */
    public function updateDetails( $data, $placeId ) {
        $place = $this->findById( $placeId );
        $place->update( $data );

        return $place;
    }

    /**
     * @return array
     */
    public static function allWithIdAndName(): array
    {
        return Category::all()->pluck( 'name', 'id' )->all();
    }



    /**
     * @return array
     */
    public static function allIdAndName(): array
    {
        return District::all()->pluck( 'name', 'id' )->all();
    }

    /**
     * @param $categoryId
     * @param $paginate
     * @return mixed
     */
    public function getByCategory($categoryId, $paginate = null )
    {
        if ($paginate){
            if ($this->relations){
                return $this->model->where('category_id',$categoryId)->with($this->relations)->orderBy('id','DESC')->paginate($paginate);
            }
            return $this->model->where('category_id',$categoryId)->orderBy('id','DESC')->paginate($paginate);
        }
        if ($this->relations){
            return $this->model->where('category_id',$categoryId)->with($this->relations)->orderBy('id','DESC')->get();
        }
        return $this->model->where('category_id',$categoryId)->orderBy('id','DESC')->get();
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function getByAll( array $data ) {
        $query = $this->model;
        if ( isset( $data['district_id'] ) ) {
            $query = $query->where( 'district_id', $data['district_id']  );
        }
        if ( isset( $data['category_id'] ) ) {
            $query = $query->where( 'category_id', $data['category_id'] );
        }
        return $query->get();
    }

}
