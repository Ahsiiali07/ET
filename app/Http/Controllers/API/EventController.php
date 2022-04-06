<?php

namespace App\Http\Controllers\API;

use App\Forms\Events\CreateEventForm;
use App\Forms\Events\UpdateEventForm;
use App\Http\Controllers\Controller;
use App\Services\EventsService;
use App\Services\JoinEventService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class EventController extends Controller
{
    /**
     * @var EventsService $service
     */
    private $service;


    public function __construct()
    {
        $this->service = new EventsService();

    }

    /**
     * @return JsonResponse
     */
    public function get(): JsonResponse
    {
        $res = $this->service->getAll(10);

        if ($res) {

            return $this->successResponse(trans('Operation Successful!'), $res);
        }
        return $this->parametersInvalidResponse();

    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function fetch($id)
    {
        $item=$this->service->findById($id);
        if ($item){
            return $this->successResponse(trans('Operation Successful!'), $item);
        }
        return $this->parametersInvalidResponse();
    }

    /**
     * @param $id
     *
     * @return JsonResponse
     */

    public function destroy( $id ): JsonResponse {
        $item = $this->service->remove( $id );
        $msg  = 'Successfully Removed!';

        if ( $item ) {

            return $this->successResponse( trans( 'Deleted Successfully!' ), $msg );
        }

        return $this->parametersInvalidResponse();
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store( Request $request ): JsonResponse {
        $form = new CreateEventForm();
        $form->loadFromArray( $request->all() );
        $item = $this->service->store( $form );
        $msg  = 'Event added successfully!';
        Session::flash( 'success', $msg );

        if ( $item ) {
            return $this->successResponse( [
                'type' => 'success',
                'msg'  => $msg,
                'data' => $item
            ] );
        }

        return $this->parametersInvalidResponse();
    }





    /**
     * @param $categoryId
     * @return JsonResponse
     */
    public function getBycategory($categoryId){
        $item =$this->service->getByCategory($categoryId);
        if ($item){
            return $this->successResponse(trans('Operation Successful!'), $item);
        }
        return $this->parametersInvalidResponse();
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function rate(Request $request, $id): JsonResponse
    {
        $user = Auth::user();
        if ($user) {
            if (isset($request->rating)) {
                if (isset($request->review)) {
                    $event = $this->service->rate(
                        $id,
                        $request->rating,
                        $user->id,
                        $request->review
                    );
                } else {
                    $event = $this->service->rate(
                        $id,
                        $request->rating,
                        $user->id
                    );
                }

                if ($event) {

                    return $this->successResponse(null, $event->load('ratings', 'ratings.user'));
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
    public function getLastEvent(): JsonResponse
    {
        if (Auth::check()) {
            $item = $this->service->getLastJoin(
                [
                    'user_id' => auth()->id()
                ]
            );

            if ($item ) {
                return $this->successResponse( null, $item );
            }

            return $this->parametersInvalidResponse('No Items Found!');
        }

        return $this->unAuthorizedResponse();
    }

}


