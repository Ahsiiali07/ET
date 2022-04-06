<?php

namespace App\Services;

use App;
use App\Models\PlaceVisited;
use App\Traits\NotificationTrait;

/**
 * Class PostLikeService
 * @package App\Services
 */
class PlaceVisitedService extends BaseService {

	/**
	 * FavoriteService constructor.
	 */
	public function __construct() {
		$this->model = new PlaceVisited();

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
     * @param $place_id
     * @return PlaceVisited
     */
	public function addToVisited( $userId, $place_id )
    {
		$item          = new PlaceVisited();
		$item->place_id = $place_id;
		$item->user_id = $userId;

		 $item->save();

		return $item;
	}

	/**
	 * @param $userId
	 * @param $place_id
	 *
	 * @return mixed
	 */
	public function removeFromVisited( $userId, $place_id ) {
		$item = $this->findFirst( [
			'user_id' => $userId,
			'place_id' => $place_id
		] );
		if ( $item ) {
			return $item->delete();
		}

		return false;
	}
}
