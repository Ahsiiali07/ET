<?php

namespace App\Http\Controllers\API;

use App\Forms\Company\CreateCompanyForm;
use App\Forms\Company\UpdateCompanyForm;
use App\Http\Controllers\Controller;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class CompanyController extends Controller
{
    /**
     * @var CompanyService $service
     */
    private $service;

    public function __construct()
    {
        $this->service = new CompanyService();
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
        return $this->parametersInvalidResponse('Not Found');
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $item=$this->service->remove($id);
        if ($item){
            return $this->successResponse(trans('Remove Successful!'), $item);
        }
        return $this->parametersInvalidResponse();
    }





    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store( Request $request ): JsonResponse {
        $form = new CreateCompanyForm;
        $form->loadFromArray( $request->all() );
        $item = $this->service->store( $form );
        $msg  = 'Company added successfully!';
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
