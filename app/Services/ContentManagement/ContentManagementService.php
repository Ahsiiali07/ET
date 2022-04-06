<?php

namespace App\Services\ContentManagement;

use App\Helpers\GeneralHelper;
use App\Models\ContentManagement;
use App\Services\BaseService;
use App\Forms\IForm;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

/**
 * Class ContentManagementService
 * @package App\Services\Users
 */
class ContentManagementService extends BaseService {

    /**
     * UserService constructor.
     */
    public function __construct() {
        /** @var ContentManagement */
        $this->model = new ContentManagement();

        parent::__construct();
    }
    /**
     * @param $slug
     *
     * @return mixed
     */
    public function getBySlug( $slug ) {
        return $this->model
            ->where( 'slug', $slug )
            ->get();
    }

    /**
     * @param $slug
     *
     * @return mixed
     */
    public function findBySlug( $slug ) {
        return $this->getBySlug( $slug )->first();
    }

    public function store( IForm $form ) {
        //
    }

    /**
     * @param IForm $form
     * @param  $userId
     *
     * @return mixed
     * @throws ValidationException
     */
    public function update( IForm $form, $userId ) {
        // Validate Form
        $form->validate();
        if ( $form->type == IContentManagement::TYPE_IMAGE ) {
            if ( $form->content ) {
                $form->content = GeneralHelper::uploadImage( $form->content, 'images/content' );
            }

        }

        $model = $this->findById( $userId );

        // Assign values to model attributes
        $form->loadToModel( $model );

        $model->save();

        return $model;
    }
}
