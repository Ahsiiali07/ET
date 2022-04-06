<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * @var CategoryService $service
     */
    private $service;

    public function __construct()
    {
        $this->service = new CategoryService();
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









}
