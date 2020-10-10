<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Modules\Auth\Entities\User;
use Modules\Auth\Repositories\RoleRepository;
use Nwidart\Modules\Routing\Controller;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    protected $model, $edition;

    protected $viewPath = 'auth::roles.';
    /**
     * @var RoleRepository
     */
    protected $repository;

    public function __construct(Role $role)
    {

        $this->middleware('auth');
        $this->middleware(['permission:role-view|role-create|role-edit|role-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:role-create'], ['only' => ['create', 'store', 'show']]);
        $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update', 'show']]);
        $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
        $this->repository = new RoleRepository($role);
    }


    public function index()
    {
        $roles = $this->repository->getAll();
        return view($this->viewPath . 'index', compact('roles'));
    }

    public function create()
    {
        return view('auth::roles.create');
    }

    public function store(Request $request)
    {
        $baseRoute = getBaseRouteByUrl($request);
        Validator::make($request->all(), [
            'name' => 'required|unique:roles,name'
        ])->validate();
        DB::beginTransaction();
        try {
            $input = $request->all();
            $role = $this->repository->create([
                'name' => $request->get('name')
            ]);
            if (isset($input['permission']))
                $role->syncPermissions($input['permission']);
            DB::commit();
            return redirect()
                ->route($baseRoute . '.index')
                ->with('success', 'Role Created Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->back()
                ->withInput()
                ->with('failed', 'Failed to create Role');
        }


    }

    public function show()
    {
        return redirect()->back();
    }

    public function edit($id)
    {
        $role = $this->repository->getById($id);
        $permissions = $role->permissions()->pluck('name');
        return view($this->viewPath . '.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $id
        ])->validate();

        DB::beginTransaction();
        try {
            $baseRoute = getBaseRouteByUrl($request);
            $input = $request->all();
            $role = $this->repository->update($id, ['name' => $input['name']]);
            if (isset($input['permission']))
                $role->syncPermissions($input['permission']);
            DB::commit();
            return redirect()
                ->route($baseRoute . '.index')
                ->with('success', 'Role Updated Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->back()
                ->withInput()
                ->with('failed', 'Failed to update Role');
        }
    }


    public function destroy(Request $request, $id)
    {
        $baseRoute = getBaseRouteByUrl($request);
        $role = $this->repository->getById($id);
        $usersCount = User::role($role)->count();
        if ($usersCount > 0) {
            return redirect()
                ->route($baseRoute . '.index')
                ->with('failed', 'Role cannot be deleted. Users are found with this role.');
        } else {
            $this->repository->delete($id);
            return redirect()
                ->route($baseRoute . '.index')
                ->with('success', 'Role deleted successfully.');
        }
    }
}
