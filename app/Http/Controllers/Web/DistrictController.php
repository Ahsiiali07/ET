<?php

namespace App\Http\Controllers\Web;

use App\Forms\District\CreateDistrictForm;
use App\Forms\District\UpdateDistrictForm;
use App\Forms\Service\CreateServiceForm;
use App\Http\Controllers\Controller;
use App\Services\DistrictService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;


class DistrictController extends Controller
{
    /**
     * @var string
     */
    private $backRoute = '/districts';

    /** @var DistrictService  */
    private $service;

    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->service = new districtService();
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $items = $this->service->getAll(20);
        return view('district.index')
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
        return view('district.create');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $form = new CreateDistrictForm();
        $form->loadFromArray($request->all());
        $district = $this->service->store($form);
        $msg = 'District added successfully!';
        Session::flash('success', $msg);

        return response()->json(
            [
                'type' => 'success',
                'msg' => $msg,
                'data' => $district
            ]
        );
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        return view('district.show')
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
        return view('district.edit')
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
        $form = new UpdateDistrictForm();
        $form->loadFromArray($request->all());
        $items = $this->service->update($form, $id);

        $msg = 'District updated successfully!';
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

