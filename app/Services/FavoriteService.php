<?php

namespace App\Services;

use App\Models\Favorite;
use App\Services\BaseService;

class FavoriteService extends BaseService
{


    /**
     * FavoriteService constructor.
     */
    public function __construct() {
        $this->model = new Favorite();

        parent::__construct();


    }


    /**
     * @param $userId
     *
     * @return mixed
     */
    public function getAllForUser( $userId ) {
        return $this->find( [
            'user_id' => $userId
        ] );
    }

    /**
     * @param $userId
     * @param $event_id
     *
     * @return bool
     */
    public function addToFavorite(  $event_id, $userId ) {
        $item             = new Favorite();
        $item->event_id = $event_id;
        $item->user_id    = $userId;

        return $item->save();
    }

    /**
     * @param $userId
     * @param $event_id
     *
     * @return mixed
     */
    public function removeFromFavorite( $userId, $event_id ) {
        $item = $this->findFirst( [
            'user_id'    => $userId,
            'event_id' => $event_id
        ] );
        if ( $item ) {
            return $item->delete();
        }

        return false;
    }



}
