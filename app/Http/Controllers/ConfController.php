<?php

namespace App\Http\Controllers;

use App\Conf;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try{
            $conf = Conf::findOrFail(1);
        } catch(ModelNotFoundException $e) {

        }
        return view('config.edit', compact('conf'));

    }

    public function update(Request $request)
    {
        $conf = Conf::findOrFail(1);

        $conf->save();
        return redirect()->back()->with('success', 'Bot Configuration Updated');
    }
}
