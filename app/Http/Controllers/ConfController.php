<?php

namespace App\Http\Controllers;

use App\Conf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfController extends Controller
{
    public function index()
    {
        $conf = Conf::where('user_id',Auth::user()->id);
        return view('conf',compact('conf'));
    }
}
