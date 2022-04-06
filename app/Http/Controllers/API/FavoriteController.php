<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\FavoriteService;
use App\Services\EventsService;
use App\Models\Event;
use App\Models\User;
use Auth;
use Illuminate\Http\JsonResponse;


class FavoriteController extends Controller
{
    /**
     * @var FavoriteController $favoriteService
     */
    private $favoriteService;
    /**
     * @var EventsService
     */
    private $eventService;

    /**
     * IntrestedController constructor.
     */
    public function __construct()
    {
        $this->favoriteService = new FavoriteService();
        $this->eventService = new EventsService();
    }

    /**
     * @param $event_id
     * @return JsonResponse
     */
    public function favoriteUnFavorite($event_id): JsonResponse
    {

        if (Auth::check()) {

            $userId = auth()->id();

            if (isset($event_id)) {

                if ($this->eventService->findById($event_id)) {

                    $item = $this->favoriteService->findFirst([
                        'user_id' => auth()->id(),
                        'event_id' => $event_id,
                    ]);

                    if ($item) {
                        $res = $this->favoriteService->removeFromFavorite($userId, $event_id);
                        if ($res) {
                            return $this->parametersInvalidResponse('Event removed from Favorite successfully!');
                        }

                        return $this->parametersInvalidResponse('Error: event not removed from Favorite!');
                    }

                    $res = $this->favoriteService->addToFavorite($userId, $event_id);

                    if ($res) {
                        return $this->successResponse('Event added to Favorite successfully!');
                    }

                    return $this->parametersInvalidResponse('Error: event not added from Interested!');
                }

                return $this->parametersInvalidResponse('No Event Found!');
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
            $items = $this->favoriteService->get(
                [
                    'user_id' => auth()->id(),
                ]
            );

            if ($items && count($items) > 0) {
                return $this->successResponse(
                    null,
                    $items->load('user', 'event')
                );
            }

            return $this->parametersInvalidResponse('No Items Found!');
        }

        return $this->unAuthorizedResponse();
    }

}
