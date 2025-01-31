<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index')->with('installedModules', request()->user()->installedModules()->get());
    }

    public function uninstall(Request $request)
    {
        $data = request()->validate(
            [
                'modules.*' => [
                    'required',
                    Rule::in(request()->user()->installedModules()->pluck('modules.id')->toArray()),
                ],
                'modules-data' => 'string|in:delete'
            ],
            [
                'modules.*' => 'There was an error during operation'
            ]
        );

        $modules = request()->user()->modules()->where('id', $data['modules']);

        if (isset($data['modules-data'])) {
            $modules->delete();
        } else {
            $modules->update(['enabled' => false]);
        }

        session()->flash('message', 'Modules uninstalled succesfuly');

        return back();
    }
}
