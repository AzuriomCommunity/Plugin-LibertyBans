<?php

namespace Azuriom\Plugin\LibertyBans\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Show the LibertyBans plugin settings page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('libertybans::admin.settings', [
            'driver' => setting('libertybans.driver', 'mysql'),
            'host' => setting('libertybans.host', '127.0.0.1'),
            'port' => setting('libertybans.port', '3306'),
            'database' => setting('libertybans.database', 'libertybans'),
            'username' => setting('libertybans.username', 'libertybans'),
            'password' => setting('libertybans.password'),
            'perPage' => setting('libertybans.perPage', 10),
            'path' => setting('libertybans.path', 'libertybans'),
        ]);
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'driver' => ['required', 'string', 'in:mysql,pgsql'],
            'host' => ['required', 'string', 'max:255'],
            'port' => ['required', 'integer', 'between:1,65535'],
            'database' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
            'perPage' => ['required', 'integer', 'between:1,100'],
            'path' => ['required', 'string', 'between:1,100'],
        ]);

        Setting::updateSettings([
            'libertybans.driver' => $request->input('driver'),
            'libertybans.host' => $request->input('host'),
            'libertybans.port' => $request->input('port'),
            'libertybans.database' => $request->input('database'),
            'libertybans.username' => $request->input('username'),
            'libertybans.password' => $request->input('password'),
            'libertybans.perPage' => $request->input('perPage'),
            'libertybans.path' => $request->input('path'),
        ]);

        return redirect()->route('libertybans.admin.settings')->with('success', trans('admin.settings.updated'));
    }
}
