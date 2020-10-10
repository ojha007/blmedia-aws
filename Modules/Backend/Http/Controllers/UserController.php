<?php


namespace Modules\Backend\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\Auth\Entities\User;
use Modules\Auth\Http\Requests\CreateUserRequest;
use Modules\Auth\Notifications\UserInvited;
use Modules\Auth\Repositories\RoleRepository;
use Modules\Auth\Repositories\UserRepository;
use Modules\Backend\Http\Responses\Response;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected $baseRoute = 'users';
    protected $viewPath = 'backend::users.';
    /**
     * @var RoleRepository
     */
    private $repository;

    public function __construct()
    {
        $this->repository = new UserRepository(new User());
    }

    public function index()
    {
        $users = User::with('roles')
            ->paginate(20);
        return new Response($this->viewPath . 'index', ['users' => $users]);
    }

    public function create()
    {
        $roles = Role::all()->pluck('name', 'name');
        return new Response($this->viewPath . 'create', ['roles' => $roles]);
    }

    public function edit(User $user)
    {
        $roles = Role::all()
            ->pluck('name', 'name');
        return new Response($this->viewPath . 'edit', ['user' => $user, 'roles' => $roles]);
    }

    public function store(CreateUserRequest $request)
    {
        $baseRoute = getBaseRouteByUrl($request);
        DB::beginTransaction();
        try {
            $password_generated = Str::random(10);
            $input = $request->all();
            $input['password'] = $this->repository->encryptPassword($password_generated);
            $user = $this->repository->create($input);
            $user->syncRoles($request->get('role'));
            $user->notify(new UserInvited($user, $password_generated));
            DB::commit();
            return redirect()->route($baseRoute . '.index')
                ->with('success', 'New user added successfully.');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->route($baseRoute . '.index')
                ->with('failed', 'Failed to create user.');
        }

    }

    public function destroy(Request $request, $id)
    {

        $baseRoute = getBaseRouteByUrl($request);
        try {
            DB::beginTransaction();
            $this->repository->delete($id);
            DB::commit();
            return redirect()->route($baseRoute . '.index')
                ->with('success', 'User deleted successfully');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route($baseRoute . '.index')
                ->with('failed', 'User cannot be deleted.');
        }
    }

    public function profile()
    {
        $user = $this->repository->getById(Auth::id());
        return view('auth::profile.index', compact('user'));
    }

    public function updateProfile(Request $request, $id)
    {
//        $input = $request->all();
//        $user = $this->repository->getById($id);
//        $user->update($input);
//        return redirect()->route($this->routePrefix . '.profile')
//            ->with('success', 'Profile updated successfully');
    }

    public function updateAvatar(Request $request)
    {
//        if ($request->hasFile('avatar')) {
//            $avatar = $request->file('avatar');
//            $filename = time() . '.' . $avatar->getClientOriginalExtension();
//            $img = Image::make($avatar->getRealPath());
//            $img->stream();
//            Storage::disk('local')->put('/public/avatars/' . $filename, $img, 'public');
//            $user = Auth::user();
//            Storage::delete('/public/avatars/' . $user->avatar);
//            $user->avatar = $filename;
//            $user->save();
//            return redirect()->route($this->routePrefix . '.profile')
//                ->with('success', 'Profile image updated successfully');
//        }
    }

    public function update(Request $request, $id)
    {
        $baseRoute = getBaseRouteByUrl($request);
        DB::beginTransaction();
        try {
            $user = $this->repository->update($id, $request->except('token'));
            $user->syncRoles($request->get('role'));
            DB::commit();
            return redirect()->route($baseRoute . '.index')
                ->with('success', 'New user added successfully.');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->route($baseRoute . '.index')
                ->with('failed', 'Failed to create user.');
        }
    }
}
