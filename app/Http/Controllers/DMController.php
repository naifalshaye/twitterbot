<?php

namespace App\Http\Controllers;

use App\DM;
use App\DMConfig;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class DMController extends Controller
{
    public function index()
    {
        $dm = DM::orderBy('id','desc')->paginate(25);
        return view('dm.index',compact('dm'));
    }

    public function dmConfig()
    {
        $dm = DMConfig::findOrFail(1);
        return view('dm.setting',compact('dm'));
    }

    public function updateConfig(Request $request)
    {
        $this->validate($request, [
            'text' => 'required',
        ]);

        $conf = DMConfig::findOrNew(1);

        if ($request->disable == 'on'){
            $request['disable'] = true;
        } else {
            $request['disable']  = false;
        }

        $conf->text = $request->text;
        $conf->disable = $request->disable;
        $conf->save();
        return redirect()->back()->with('success','DM settings updated.');
    }
}
