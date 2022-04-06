<?php

namespace App\Http\Controllers\Web;

use App\Forms\Category\CreateCategoryForm;
use App\Forms\Category\UpdateCategoryForm;
use App\Forms\Service\CreateServiceForm;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\NewsService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;


class CategoryController extends Controller
{
    /**
     * @var string
     */
    private $backRoute = '/categories';

    /** @var CategoryService  */
    private $service;

    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->service = new categoryService();
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $items = $this->service->getAll(20);
        return view('category.index')
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
        return view('category.create');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $form = new CreateCategoryForm();
        $form->loadFromArray($request->all());
        $category = $this->service->store($form);
        $msg = 'Category added successfully!';
        Session::flash('success', $msg);

        return response()->json(
            [
                'type' => 'success',
                'msg' => $msg,
                'data' => $category
            ]
        );
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        return view('category.show')
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
        return view('category.edit')
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
        $form = new UpdateCategoryForm();
        $form->loadFromArray($request->all());
        $items = $this->service->update($form, $id);

        $msg = 'Category updated successfully!';
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

