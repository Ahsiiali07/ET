<?php

namespace App\Http\Controllers\Web;

use App\Forms\Places\CreatePlaceForm;
use App\Forms\Places\UpdatePlaceForm;
use App\Forms\Service\CreateServiceForm;
use App\Http\Controllers\Controller;
use App\Services\PlacesService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;




class PlacesController extends Controller
{
    /**
     * @var string
     */
    private $backRoute = '/places';

    /** @var PlacesService  */
    private $service;

    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->service = new placesService();
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $items = $this->service->getAll(20);
        return view('place.index')
            ->with(
                [
                    'items' => $items,
                ]
            );
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('place.create');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $form = new CreatePlaceForm();
        $form->loadFromArray($request->all());
        $place = $this->service->store($form);
        $msg = 'place added successfully!';
        Session::flash('success', $msg);

        return response()->json(
            [
                'type' => 'success',
                'msg' => $msg,
                'data' => $place
            ]
        );
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        return view('place.show')
            ->with([
                'item' => $this->service->findById($id)
            ]);
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        return view('place.edit')
            ->with([
                'item' => $this->service->findById($id)
            ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id): JsonResponse
    {
        $form = new UpdatePlaceForm();
        $form->loadFromArray($request->all());
        $items = $this->service->update($form, $id);

        $msg = 'place updated successfully!';
        Session::flash('success', $msg);

        return response()->json(
            [
                'type' => 'success',
                'msg' => $msg,
                'data' => $items
            ]
        );
    }

    /**
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */

    public function destroy($id)
    {
        $this->service->remove($id);

        // Set flash
        Session::flash('success', 'Successfully Removed!');

        // Redirect to users
        return redirect($this->backRoute);
    }

}

