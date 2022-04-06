<?php

namespace App\Http\Controllers;

use App\Helpers\User;
use App\Services\CompanyService;
use App\Services\Modules\ModuleService;
use App\Services\Offices\OfficeService;
use App\Services\Users\UserService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller {
    /**
     * @var UserService $userService
     */
    public $userService;

    /**
     * DashboardController constructor.
     */
    public function __construct() {
        $this->middleware( 'auth' );
        $this->userService    = new UserService;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index() {
        return view( 'home' );
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function dashboard() {
        return view( 'home' );
    }
}
