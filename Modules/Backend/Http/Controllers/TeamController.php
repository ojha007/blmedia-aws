<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Backend\Entities\Team;
use Modules\Backend\Http\Requests\TeamRequest;
use Modules\Backend\Http\Responses\Response;
use Modules\Backend\Repositories\TeamRepository;


class TeamController extends Controller
{
    protected $baseRoute = 'news';
    protected $viewPath = 'backend::team.';
    /**
     * @var Team
     */
    private $model;
    /**
     * @var TeamRepository
     */
    private $repository;

    public function __construct(Team $team)
    {

        $this->model = $team;
        $this->repository = new TeamRepository($team);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $teams = $this->repository->getAll();
        return new Response($this->viewPath . 'index', ['teams' => $teams]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $viewPath = $this->viewPath . 'create';
        return new Response($viewPath, null);
    }


    public function store(TeamRequest $request)
    {
        $attributes = $request->validated();
        $baseRoute = getBaseRouteByUrl($request);
        try {
            DB::beginTransaction();
            $attributes['image'] = $this->storeImage($request);
            $this->repository->create($attributes);
            DB::commit();
            return redirect()->route($baseRoute . '.index')
                ->with('success', 'Team Created SuccessFully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            DB::rollBack();
            return redirect()->back()->withInput()
                ->with('failed', 'Failed to create Team');
        }
    }

    protected function storeImage($request)
    {
        if ($request->has('image')) {
            $folder = $request->route()->getAction('edition') . '/teams';
            return $request->file('image')->store($folder);
        }
        return null;
    }

    /**
     * Display the specified resource.
     *
     * @param Team $team
     * @return Response
     */
    public function show(Team $team)
    {
        return new Response($this->viewPath . 'show', ['news' => $team]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Team $team
     * @return Response
     */
    public function edit(Team $team)
    {
        $viewPath = $this->viewPath . 'edit';
        return new Response($viewPath, ['team' => $team]);
    }

    public function update(TeamRequest $request, $id)
    {
        $attributes = $request->validated();
        $baseRoute = getBaseRouteByUrl($request);
        try {
            DB::beginTransaction();
            $attributes['image'] = $this->storeImage($request);
            $this->repository->update($id, $attributes);
            DB::commit();
            return redirect()->route($baseRoute . '.index')
                ->with('success', 'Team Updated SuccessFully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            DB::rollBack();
            return redirect()->back()->withInput()
                ->with('failed', 'Failed to Update Team');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Team $team
     * @return RedirectResponse
     */
    public function destroy(Request $request, Team $team)
    {
        $baseRoute = getBaseRouteByUrl($request);
        try {
            DB::beginTransaction();
            $team->delete();
            DB::commit();
            return redirect()->route($baseRoute . '.index')
                ->with('success', 'Team Deleted SuccessFully');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->route($baseRoute . '.index')
                ->with('failed', 'Failed to delete Team.');
        }


    }
}
