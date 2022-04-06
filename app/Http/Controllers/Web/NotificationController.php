<?php

namespace App\Http\Controllers\Web;

use App\Helpers\User;
use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
class NotificationController extends Controller {
    /**
     * @var NotificationService $service
     */
    public $service;

    /**
     * DashboardController constructor.
     */
    public function __construct() {
        $this->middleware( 'auth' );
        $this->service    = new NotificationService;
    }

    /**
     * @return Application|Factory|View
     */
    public function create(){
        return view('notification.create');
    }
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function sendNotification( Request $request): JsonResponse
    {
        $this->service->sendNotification( $request );
        $msg = 'Successfully Sent!';
        Session::flash('success', $msg);

        return response()->json(
            [
                'type' => 'success',
                'msg' => $msg,
            ]
        );
    }
}
