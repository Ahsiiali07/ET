<?php

namespace App\Http\Controllers\API;

use App\Services\PlacesService;
use App\Services\PlaceVisitedService;
use Auth;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

/**
 * Class PostLikeController
 * @package App\Http\Controllers\API
 */
class PlaceVisitedController extends Controller
{

    /**
     * @var PlaceVisitedService $service
     */
    private $service;

    /**
     * @var PlacesService
     */
    private $placesService;

    /**
     * FavoriteController constructor.
     */
    public function __construct()
    {
        $this->service = new PlaceVisitedService();
        $this->placesService = new PlacesService();
    }

    /**
     * @param $placeId
     *
     * @return JsonResponse
     */
    public function visitedUnvisited($placeId): JsonResponse
    {

        if (Auth::check()) {

            $userId = auth()->id();

            if (isset($placeId)) {
                if ($ser = $this->placesService->findById($placeId)) {

                    $item = $this->service->findFirst([
                        'user_id' => auth()->id(),
                        'place_id' => $placeId,
                    ]);

                    if ($item) {
                        $res = $this->service->removeFromVisited($userId, $placeId);
                        if ($res) {
                            return $this->successResponse('Place  Un-Visited successfully!');
                        }

                        return $this->parametersInvalidResponse('Error: place not removed from visited places!');
                    }

                    $res = $this->service->addToVisited($userId, $placeId);

                    if ($res) {
                        return $this->successResponse('Place  Visited successfully!');
                    }

                    return $this->parametersInvalidResponse('Error: place not visited!');
                }

                return $this->parametersInvalidResponse('No Post Found!');
            }

            return $this->parametersInvalidResponse();
        }

        return $this->unAuthorizedResponse();
    }

    /**
     * @return JsonResponse
     */
    public function getAllAgainstUser(): JsonResponse
    {
        if (Auth::check()) {
            $items = $this->service->get(
                [
                    'user_id' => auth()->id(),
                ]
            );

            if ($items && count($items) > 0) {
                return $this->successResponse(
                    null,
                    $items->load('user', 'place', 'place.category')
                );
            }

            return $this->parametersInvalidResponse('No Items Found!');
        }

        return $this->unAuthorizedResponse();
    }


}
