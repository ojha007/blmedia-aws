<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Backend\Http\Responses\Response;


class SettingController extends Controller
{

    /**
     * @var string
     */
    protected $routePrefix = 'settings';
    /**
     * @var string
     */
    protected $viewPath = 'backend::setting.';
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:setting-view|setting-create|setting-edit|setting-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:setting-create'], ['only' => ['create', 'store', 'show']]);
        $this->middleware(['permission:setting-edit'], ['only' => ['edit', 'update', 'show']]);
        $this->middleware(['permission:setting-delete'], ['only' => ['destroy']]);
    }


    public function index()
    {

        $site_settings = $this->getSettingAttributes();
        return new Response($this->viewPath . 'index', ["site_settings" => $site_settings]);
    }

    public function getSettingAttributes()
    {
        return [
            'general_setting' => [
                'website_name' => 'text',
                'slogan' => 'text',
                'website_url' => 'text',
                'website_email' => 'email',
                'contact_number' => 'tel',
                'opening_hours' => 'time',
                'address' => 'text',
                'default_logo' => 'file',
                'description' => 'textarea',
                'map' => 'textarea',
            ],
            'social_media_setting' => [
                'facebook' => 'text',
                'twitter' => 'text',
                'instagram' => 'text',
                'youtube' => 'text',
                'skype' => 'text',
                'whatsapp' => 'text',
                'google' => 'text',
                'linked in' => 'text',
            ],
            'meta_setting' => [
                'meta_title' => 'text',
                'meta_keywords' => 'textarea',
                'meta_description' => 'textarea',
            ],
            'organization_setting' => [
                'vat_number' => 'number',
            ]

        ];
    }

    public function store(Request $request)
    {
        $attributes = $request->all();
        foreach ($attributes as $name => $value) {
            if ($value)
                \Setting::set($name, $value);
        }
        \Setting::save();
        return redirect()->back()
            ->with('success', 'Setting Created successfully');

    }
    public function destroy(){

    }


}
