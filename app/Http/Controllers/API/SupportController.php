<?php

namespace App\Http\Controllers\API;

use App\Services\SupportService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class SupportController
 * @package App\Http\Controllers\API
 */
class SupportController extends Controller {

    /**
     * @var SupportService $userService
     */
    private $supportService;

    /**
     * UserController constructor.
     */
    public function __construct() {
        $this->supportService = new SupportService();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function sendSupportRequest( Request $request ): JsonResponse
    {
        if ( isset( $request['name_en'], $request['name_sp'], $request['description_en'], $request['description_sp'], $request['client_email'] ) ) {
            $supportRequest = $this->supportService->supportRequest(
                $request['name_en'],
                $request['name_sp'],
                $request['client_email'],
                $request['description_en'],
                $request['description_sp']
            );
            if ( $request ) {
                return $this->successResponse( trans('support.Support Request Sent!'), $supportRequest );
            }

            return $this->unAuthorizedResponse();
        }

        return $this->parametersInvalidResponse();
    }
}
