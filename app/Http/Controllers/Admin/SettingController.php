<?php

namespace App\Http\Controllers\Admin;

use App\Models;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class SettingController extends BaseAdminController
{
    public $bodyClass = 'setting-controller', $routeLink = 'settings';
    public function __construct()
    {
        parent::__construct();

        $this->middleware('is_webmaster');

        $this->_setPageTitle('Settings', 'manage website settings');
        $this->_setBodyClass($this->bodyClass);

        $this->_loadAdminMenu($this->routeLink);
    }

    public function index()
    {
        $settings = Models\Setting::orderBy('order', 'ASC')->get();

        $pages = Models\Page::getBy([
            'status' => 1,
        ], ['title' => 'ASC'], true);

        return $this->_viewAdmin('settings.index', compact('settings', 'pages'));
    }

    public function create(Request $request, Models\Setting $setting)
    {
        $setting->createItem($request->all());

        $this->_setFlashMessage('Successfully Created New Setting', 'success');
       
        $this->_showFlashMessages();
        return redirect()->back();
    }

    public function delete($id)
    {
        Models\Setting::destroy($id);

        $this->_setFlashMessage('Successfully Deleted Setting', 'success');
       
        $this->_showFlashMessages();
        return redirect()->back();
    }

    public function delete_value($id)
    {
        $setting = Models\Setting::find($id);

        if (isset($setting->id)) {
            // If the type is an image... Then delete it
            if ($setting->type == 'image') {
                if (Storage::exists(config('voyager.storage.subfolder').$setting->value)) {
                    Storage::delete(config('voyager.storage.subfolder').$setting->value);
                }
            }
            $setting->value = '';
            $setting->save();
        }

        $this->_setFlashMessage('Successfully removed {$setting->display_name} value', 'success');

        $this->_showFlashMessages();
        return redirect()->back();
    }


    public function save(Request $request)
    {
        $settings = Models\Setting::all();
        foreach ($settings as $setting) {
            $content = $this->getContentBasedOnType($request, 'settings', (object) [
                'type'    => $setting->type,
                'field'   => $setting->option_key,
            ]);

            if ($content === null && isset($setting->option_value)) {
                $content = $setting->option_value;
            }

            $setting->option_value = $content;
            $setting->save();
        }

        $this->_setFlashMessage('Successfully Saved Settings', 'success');

        $this->_showFlashMessages();

        return redirect()->back();
    }
    
    private function getContentBasedOnType(Request $request, $slug, $row)
    {
        $content = null;
        switch ($row->type) {
            /********** PASSWORD TYPE **********/
            case 'password':
                $pass_field = $request->input($row->field);

                if (isset($pass_field) && !empty($pass_field)) {
                    return bcrypt($request->input($row->field));
                }
                break;

            /********** CHECKBOX TYPE **********/
            case 'checkbox':
                $checkBoxRow = $request->input($row->field);

                if (isset($checkBoxRow)) {
                    return 1;
                }

                $content = 0;
                break;

            /********** FILE TYPE **********/
            case 'file':
                $file = $request->file($row->field);
                $filename = Str::random(20);
                $path = $slug.'/'.date('F').date('Y').'/';

                $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();


                return $fullPath;

            /********** ALL OTHER TEXT TYPE **********/
            default:
                return $request->input($row->field);
        }

        return $content;
    }
}
