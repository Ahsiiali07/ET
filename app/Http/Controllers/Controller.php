<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\IResponseCodes;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param null $msg
     *
     * @return JsonResponse
     */
    public function unAuthorizedResponse($msg = null): JsonResponse
    {
        if ($msg) {
            return response()->json([
                'message' => $msg,
                'success' => false,
                'status' => IResponseCodes::UNAUTHORISED
            ]);
        }

        return response()->json([
            'message' => trans('User Unauthorized!'),
            'success' => false,
            'status' => IResponseCodes::UNAUTHORISED
        ]);

    }

    /**
     * @param null $msg
     * @param null $errors
     *
     * @return JsonResponse
     */
    public function parametersInvalidResponse($msg = null, $errors = null): JsonResponse
    {
        if ($msg) {
            if ($errors) {
                return response()->json([
                    'message' => $msg,
                    'errors' => $errors,
                    'success' => false,
                    'status' => IResponseCodes::UNPROCESSABLE_ENTITY
                ]);
            }

            return response()->json([
                'message' => $msg,
                'success' => false,
                'status' => IResponseCodes::UNPROCESSABLE_ENTITY
            ]);
        }
        if ($errors) {
            return response()->json([
                'message' => trans('Parameters Invalid!'),
                'errors' => $errors,
                'success' => false,
                'status' => IResponseCodes::UNPROCESSABLE_ENTITY
            ]);
        }

        return response()->json([
            'message' => trans('Parameters Invalid!'),
            'success' => false,
            'status' => IResponseCodes::UNPROCESSABLE_ENTITY
        ]);

    }

    /**
     * @param null $msg
     * @param null $data
     *
     * @return JsonResponse
     */
    public function successResponse($msg = null, $data = null, $success = true): JsonResponse
    {
        if ($msg) {
            if ($data) {
                return response()->json([
                    'message' => $msg,
                    'data' => $data,
                    'success' => $success,
                    'status' => IResponseCodes::SUCCESS
                ]);
            }

            return response()->json([
                'message' => $msg,
                'success' => $success,
                'status' => IResponseCodes::SUCCESS
            ]);
        }
        if ($data) {
            return response()->json([
                'message' => trans('Operation Successful!'),
                'data' => $data,
                'success' => $success,
                'status' => IResponseCodes::SUCCESS
            ]);
        }

        return response()->json([
            'message' => trans('Operation Successful!'),
            'success' => $success,
            'status' => IResponseCodes::SUCCESS
        ]);

    }
}
