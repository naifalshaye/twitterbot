<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::findOrNew(1);
        return view('config.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Setting::findOrNew(1);

        if ($request->bot_power == 'on'){
            $request['bot_power'] = true;
        } else {
            $request['bot_power']  = false;
        }
        if ($request->chat_power == 'on'){
            $request['chat_power'] = true;
        } else {
            $request['chat_power']  = false;
        }
        if ($request->archive_power == 'on'){
            $request['archive_power'] = true;
        } else {
            $request['archive_power']  = false;
        }
        if ($request->schedule_power == 'on'){
            $request['schedule_power'] = true;
        } else {
            $request['schedule_power']  = false;
        }
        if ($request->onfollow_power == 'on'){
            $request['onfollow_power'] = true;
        } else {
            $request['onfollow_power']  = false;
        }
        if ($request->stop_register == 'on'){
            $request['stop_registration'] = true;
        } else {
            $request['stop_registration']  = false;
        }
        if ($request->hide_error_log == 'on'){
            $request['hide_error_log'] = true;
        } else {
            $request['hide_error_log']  = false;
        }

        $settings->consumer_key = $request->consumer_key;
        $settings->consumer_secret = $request->consumer_secret;
        $settings->access_token = $request->access_token;
        $settings->access_secret = $request->access_secret;

        $settings->bot_power = $request->bot_power;
        $settings->chat_power = $request->chat_power;
        $settings->archive_power = $request->archive_power;
        $settings->schedule_power = $request->schedule_power;
        $settings->onfollow_power = $request->onfollow_power;
        $settings->stop_registration = $request->stop_registration;
//        $settings->hide_error_log = $request->hide_error_log;
        $settings->save();
        return redirect()->back()->with('success', 'Bot Settings have been updated successfully');
    }

}
