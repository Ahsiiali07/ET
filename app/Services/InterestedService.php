<?php

namespace App\Services;

use App\Models\Intrested;
use App\Services\BaseService;

class InterestedService extends BaseService
{


    /**
     * FavoriteService constructor.
     */
    public function __construct() {
        $this->model = new Intrested();

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
     * @return mixed
     */
    public function addToInterested(  $userId, $event_id ) {
        $item             = new Intrested();
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
    public function removeFromNotInterested( $userId, $event_id ) {
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
