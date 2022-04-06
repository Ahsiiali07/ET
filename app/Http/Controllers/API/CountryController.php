<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\CountryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /** @var CountryService $service */
    private $service;

    public function __construct()
    {
        $this->service = new CountryService();
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
        $item = $this->service->findById($id);
        if ($item) {
            return $this->successResponse(trans('Operation Successful!'), $item);
        }

        return $this->parametersInvalidResponse();
    }
}
