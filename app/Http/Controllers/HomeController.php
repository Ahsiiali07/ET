<?php

namespace App\Http\Controllers;

use App\Services\Users\UserService;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller {

    /** @var UserService */
    private $userService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware( 'auth' );
        $this->userService = new UserService();
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index() {
        $totalUsers     = $this->userService->getAll();
        $toDaysUsers    = $this->userService->toDaysAll();
        $lastWeekUsers  = $this->userService->lastWeekAll();
        $lastMonthUsers = $this->userService->lastMonthAll();

        return view( 'home' )->with( [
            'totalUsers'     => count( $totalUsers ),
            'toDaysUsers'    => count( $toDaysUsers ),
            'lastWeekUsers'  => count( $lastWeekUsers ),
            'lastMonthUsers' => count( $lastMonthUsers ),
        ] );
    }
}
