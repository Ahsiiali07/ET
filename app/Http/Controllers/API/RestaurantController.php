<?php

namespace App\Http\Controllers\API;

use App\Forms\Restaurants\CreateRestaurantForm;
use App\Forms\Restaurants\UpdateRestaurantForm;
use App\Http\Controllers\Controller;
use App\Services\RestaurantsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class RestaurantController extends Controller
{
    /**
     * @var RestaurantsService $service
     */
    private $service;

    public function __construct()
    {
        $this->service = new RestaurantsService();
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
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $item=$this->service->remove($id);
        if ($item){
            return $this->successResponse(trans('Operation Successful!'), $item);
        }
        return $this->parametersInvalidResponse();
    }





    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store( Request $request ): JsonResponse {
        $form = new CreateRestaurantForm;
        $form->loadFromArray( $request->all() );
        $item = $this->service->store( $form );
        $msg  = 'Restaurant added successfully!';
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
}
