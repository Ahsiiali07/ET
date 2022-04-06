<?php

namespace App\Services;

use App\Helpers\GeneralHelper;
use App\Models\District;
use App\Forms\IForm;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

/**
 * Class DistrictService
 * @package App\Services
 */
class DistrictService extends BaseService {

    /**
     * CategoryService constructor.
     */
    public function __construct() {
        $this->model = new District();

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
     * @return District
     * @throws ValidationException
     */
    public function store( IForm $form ) {
        $form->validate();
        if ( $form->image_url ) {
            $form->image_url = GeneralHelper::uploadImageManual( $form->image_url, 'images/district' );
        }
        $district = new District();
        $form->loadToModel( $district );
        $district->save();

        return $district;
    }

    /**
     * @param IForm $form
     * @param  $districtId
     *
     * @return mixed
     * @throws ValidationException
     */
    public function update( IForm $form, $districtId ) {
        $form->validate();
        if ( $form->image_url ) {
            $form->image_url = GeneralHelper::uploadImageManual( $form->image_url, 'images/district', ( ! $form->old_image_url ) ?: true, $form->old_image_url ?? null );
        } else {
            $form->image_url = $form->old_image_url;
        }
        $district = $this->findById( $districtId );
        $form->loadToModel( $district );
        $district->update();

        return $district;
    }

    /**
     * @param $data
     * @param $districtId
     *
     * @return mixed
     */
    public function updateDetails( $data, $districtId ) {
        $district = $this->findById( $districtId );
        $district->update( $data );

        return $district;
    }

    /**
     * @return array
     */
    public static function allIdAndName(): array
    {
        return District::all()->pluck( 'name', 'id' )->all();
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function filter( array $data ) {
        $query = $this->model;
        if ( isset( $data['name'] ) ) {
            $query = $query->where( 'name', $data['name']  );
        }
        if ( isset( $data['category_id'] ) ) {
            $query = $query->where( 'category_id', $data['category_id'] );
        }
        return $query->get();
    }
}
