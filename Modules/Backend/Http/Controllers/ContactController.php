<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\Backend\Entities\Contact;
use Modules\Backend\Http\Requests\ContactRequest;
use Modules\Backend\Http\Responses\Response;
use Modules\Backend\Repositories\ContactRepository;

class ContactController extends Controller
{

    /**
     * @var string
     */
    protected $viewPath = 'backend::contacts';

    protected $type;

    private $model;
    /**
     * @var ContactRepository
     */
    private $repository;

    public function __construct(Contact $contact)
    {
        $this->model = $contact;
        $this->repository = new ContactRepository($contact);
        $this->middleware('auth');
        $this->middleware(['permission:contact-view|contact-create|contact-edit|contact-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:contact-create'], ['only' => ['create', 'store', 'show']]);
        $this->middleware(['permission:contact-edit'], ['only' => ['edit', 'update', 'show']]);
        $this->middleware(['permission:contact-delete'], ['only' => ['destroy']]);

    }

    public function index()
    {

        $viewPath = $this->viewPath . '.index';
        $contacts = $this->repository->getAll()
        ->sortByDesc('id');
        return new Response($viewPath, [
            'contacts' => $contacts,
            'type' => $this->model->getType()
        ]);
    }

    public function create()
    {
        $viewPath = $this->viewPath . '.create';
        return new Response($viewPath, [
            'type' => $this->model->getType()
        ]);

    }

    public function edit($id)
    {

        $contact = $this->repository->getById($id);

        $viewPath = $this->viewPath . '.edit';
        return new Response($viewPath, [
            'type' => $this->model->getType(),
            'contact' => $contact
        ]);

    }

    public function store(ContactRequest $request)
    {
        $attributes = $request->validated();;

        try {
            DB::beginTransaction();
            $this->repository->create($attributes);
            DB::commit();
            $baseRoute = getBaseRouteByUrl($request);
            return redirect()->route($baseRoute . '.index')
                ->with('success', $this->model->getType() . ' Created Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->back()
                ->withInput()
                ->with('failed', 'Failed to update ' . $this->model->getType());

        }

    }

    public function update(ContactRequest $request, $id)
    {

        $attributes = $request->validated();
        try {
            DB::beginTransaction();
//            $attributes['image'] = $this->storeImage($request);
            $this->repository->update($id, $attributes);
            DB::commit();
            $baseRoute = getBaseRouteByUrl($request);
            return redirect()->route($baseRoute . '.index')
                ->with('success', $this->model->getType() . ' updated Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->back()
                ->withInput()
                ->with('failed', 'Failed to update ' . $this->model->getType());
        }

    }

    protected function storeImage($request)
    {
        if ($request->has('image')) {
            $folder = $request->route()->getAction('edition') . '/' . Str::lower($this->type);
            return $request->file('image')->store($folder);
        }
        return null;
    }

    public function destroy(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->repository->delete($id);
            DB::commit();
            return redirect()->back()
                ->with('success', 'Contact deleted Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->back()
                ->withInput()
                ->with('failed', 'Failed to delete contact .');

        }
    }
}
