<?php

namespace App\Http\Controllers\API;

use App\Services\ContentManagement\ContentManagementService;
use App\Services\ContentManagement\IContentManagement;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

/**
 * Class ContentManagementController
 * @package App\Http\Controllers\API
 */
class ContentManagementController extends Controller {

    /**
     * @var ContentManagementService $contentManagementService
     */
    private $contentManagementService;

    /**
     * ContentManagementController constructor.
     */
    public function __construct() {
        $this->contentManagementService = new ContentManagementService();
    }

    /**
     * About Us api
     *
     * @return JsonResponse
     */
    public function aboutUs(): JsonResponse
    {
        $content = $this->contentManagementService->findBySlug( IContentManagement::ABOUT_US );
        if ( $content ) {
            return $this->successResponse( null, $content );
        }

        return $this->parametersInvalidResponse();

    }

    /**
     * Term&Conditions api
     *
     * @return JsonResponse
     */
    public function terms(): JsonResponse
    {
        $content = $this->contentManagementService->findBySlug( IContentManagement::TERMS );
        if ( $content ) {
            return $this->successResponse( null, $content );
        }

        return $this->parametersInvalidResponse();

    }

    /**
     * Privacy Policy api
     *
     * @return JsonResponse
     */
    public function privacy(): JsonResponse
    {
        $content = $this->contentManagementService->findBySlug( IContentManagement::PRIVACY );
        if ( $content ) {
            return $this->successResponse( null, $content );
        }

        return $this->parametersInvalidResponse();

    }

    /**
     * HOW IT WORKS api
     *
     * @return JsonResponse
     */
    public function howItWorks(): JsonResponse
    {
        $content = $this->contentManagementService->findBySlug( IContentManagement::HOW_IT_WORKS_PAGE );
        if ( $content ) {
            return $this->successResponse( null, $content );
        }

        return $this->parametersInvalidResponse();

    }

    /**
     * Banner api
     *
     * @return JsonResponse
     */
    public function banner(): JsonResponse
    {
        $content = $this->contentManagementService->findBySlug( IContentManagement::BANNER );
        if ( $content ) {
            return $this->successResponse( null, $content );
        }

        return $this->parametersInvalidResponse();

    }
}
