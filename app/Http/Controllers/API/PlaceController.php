<?php

namespace App\Http\Controllers\API;

use App\Forms\Places\CreateplaceForm;
use App\Forms\Places\UpdatePlaceForm;
use App\Http\Controllers\Controller;
use App\Services\PlacesService;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PlaceController extends Controller
{
    /**
     * @var PlacesService $service
     */
    private $service;

    public function __construct()
    {
        $this->service = new PlacesService();
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
    public function fetch($id): JsonResponse
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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store( Request $request ): JsonResponse {
        $form = new CreatePlaceForm();
        $form->loadFromArray( $request->all() );
        $item = $this->service->store( $form );
        $msg  = 'Place added successfully!';
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
     * @return JsonResponse
     */
    public function getByAll(Request $request)
    {

        $res = $this->service->getByAll($request->all());
        if ($res) {

            return $this->successResponse(trans('Operation Successful!'),$res);
        }

        return $this->parametersInvalidResponse();


        }



}
