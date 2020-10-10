<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Backend\Entities\Advertisement;
use Modules\Backend\Entities\News;
use Modules\Backend\Http\Requests\AdvertisementRequest;
use Modules\Backend\Http\Responses\Response;
use Modules\Backend\Repositories\AdvertisementRepository;


class AdvertisementController extends Controller
{

    protected $routePrefix = 'advertisements';
    protected $viewPath = 'backend::advertisement.';
    /**
     * @var News
     */
    private $model;

    private $repository;

    public function __construct(Advertisement $advertisement)
    {

        $this->middleware('auth');
        $this->middleware(['permission:advertisement-view|advertisement-create|advertisement-edit|advertisement-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:advertisement-create'], ['only' => ['create', 'store', 'show']]);
        $this->middleware(['permission:advertisement-edit'], ['only' => ['edit', 'update', 'show']]);
        $this->middleware(['permission:advertisement-delete'], ['only' => ['destroy']]);
        $this->model = $advertisement;
        $this->repository = new AdvertisementRepository($advertisement);

    }


    public function index()
    {
        $advertisements = $this->repository->getAll()
            ->sortByDesc('id');
        return new Response($this->viewPath . 'index', ['advertisements' => $advertisements]);
    }

    public function create()
    {
        $viewPath = $this->viewPath . 'create';
        $viewData = $this->repository->getViewData(new Advertisement());
        return new Response($viewPath, $viewData);
    }

    public function edit(Advertisement $advertisement)
    {
        $viewPath = $this->viewPath . 'edit';
        $viewData = $this->repository->getViewData($advertisement);
        return new Response($viewPath, $viewData);
    }

    public function update(AdvertisementRequest $request, $id)
    {
        $attributes = $request->validated();
        $baseRoute = getBaseRouteByUrl($request);
        try {
            DB::beginTransaction();
            $this->repository->update($id, $attributes);
            DB::commit();
            return redirect()->route($baseRoute . '.index')
                ->with('success', 'Advertisement Updated SuccessFully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            DB::rollBack();
            return redirect()->back()->withInput()
                ->with('failed', 'Failed to Update Advertisement');
        }
    }

    public function store(AdvertisementRequest $request)
    {
        $attributes = $request->validated();
        try {
            $baseRoute = getBaseRouteByUrl($request);
            DB::beginTransaction();
            $this->repository->create($attributes);
            DB::commit();
            return redirect()->route($baseRoute . '.index')
                ->with('success', 'Advertisement Created SuccessFully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            DB::rollBack();
            return redirect()->back()->withInput()
                ->with('failed', 'Failed to create Advertisement');
        }
    }

    public function show(Advertisement $advertisement)
    {
        return new Response($this->viewPath . 'show', ['advertisement' => $advertisement]);
    }

    public function destroy(Request $request, Advertisement $advertisement)
    {
        $baseRoute = getBaseRouteByUrl($request);
        try {
            DB::beginTransaction();
            $advertisement->delete();
            DB::commit();
            return redirect()->route($baseRoute . '.index')
                ->with('success', 'Advertisement Deleted SuccessFully');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->back()
                ->with('failed', 'Failed to delete advertisement.');

        }

    }


}
