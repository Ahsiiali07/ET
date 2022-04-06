<?php

namespace App\Http\Controllers\Web;

use App\Forms\Company\CreateCompanyForm;
use App\Forms\Company\UpdateCompanyForm;
use App\Forms\ContentForm;
use App\Services\CompanyService;
use App\Services\ContentManagement\ContentManagementService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * Class ContentManagementController
 * @package App\Http\Controllers\Web
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
        $this->middleware( 'auth' );
        $this->contentManagementService = new ContentManagementService();
    }

    /**
     * @return Application|Factory|View
     */
    public function index() {
        return view( 'content_management.index' )
            ->with(
                [
                    'items' => $this->contentManagementService->getAll( 20 )
                ]
            );
    }

    /**
     * @return Application|Factory|View
     */
    public function create() {
        return view( 'content_management.create' );
    }

    /**
     * @param $id
     *
     * @return Application|Factory|View
     */
    public function edit( $id ) {
        return view( 'content_management.edit' )
            ->with( [
                'item' => $this->contentManagementService->findById( $id )
            ] );
    }

    /**
     * @param $id
     *
     * @return Application|Factory|View
     */
    public function show( $id ) {
        return view( 'content_management.show' )
            ->with( [
                'item' => $this->contentManagementService->findById( $id )
            ] );
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update( Request $request, $id ) {
        $form = new ContentForm();
        $form->loadFromArray( $request->all() );
        $item = $this->contentManagementService->update( $form, $id );
        $msg     = 'Content updated successfully!';
        Session::flash( 'success', $msg );

        return response()->json(
            [
                'type' => 'success',
                'msg'  => $msg,
                'data' => $item
            ]
        );
    }

    /**
     * @param $id
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy( $id ) {
        $this->contentManagementService->remove( $id );

        // Set flash
        Session::flash( 'success', 'Successfully Removed!' );

        // Redirect to users
        return redirect( '/companies' );
    }


}
