<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\DistrictService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * @var DistrictService $service
     */
    private $service;

    public function __construct()
    {
        $this->service = new DistrictService();
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
     * @return JsonResponse
     */
    public function filter(Request $request)
    {

        $res = $this->service->filter($request->all());
        if ($res) {

            return $this->successResponse(trans('Operation Successful!'),$res);
        }

        return $this->parametersInvalidResponse();


    }









}
