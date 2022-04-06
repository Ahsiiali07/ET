<?php

namespace App\Http\Controllers\Web;

use App\Services\CompanyService;
use App\Services\PartnerService;
use App\Services\SupportService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * Class SupportController
 * @package App\Http\Controllers\Web
 */
class SupportController extends Controller {

    /**
     * @var SupportService $supportService
     */
    private $supportService;

    /**
     * SupportController constructor.
     */
    public function __construct() {
        $this->middleware( 'auth' );
        $this->supportService = new SupportService();
    }

    /**
     * @return Application|Factory|View
     */
    public function index() {
        return view( 'support.index' )
            ->with(
                [
                    'requests' => $this->supportService->getAll( 20 )
                ]
            );
    }

    /**
     * @param $id
     *
     * @return Application|Factory|View
     */
    public function show( $id ) {
        return view( 'support.show' )
            ->with(
                [
                    'request' => $this->supportService->findById( $id )
                ]
            );
    }

    /**
     * @param $id
     *
     * @return JsonResponse
     */
    public function open( $id ) {
        $request = $this->supportService->open( $id );
        $msg     = 'Support request status is set open!';
        Session::flash( 'success', $msg );

        return response()->json(
            [
                'type' => 'success',
                'msg'  => $msg,
                'data' => $request
            ]
        );
    }

    /**
     * @param $id
     *
     * @return JsonResponse
     */
    public function close( $id ) {
        $request = $this->supportService->close( $id );
        $msg     = 'Support request status is set closed!';
        Session::flash( 'success', $msg );

        return response()->json(
            [
                'type' => 'success',
                'msg'  => $msg,
                'data' => $request
            ]
        );
    }


}
