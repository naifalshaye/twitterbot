<?php

namespace App\Http\Controllers;

use App\Streaming;
use Illuminate\Http\Request;

class StreamingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $streaming = Streaming::OrderBy('id','desc')->paginate(15);
        return view('streaming.index', compact('streaming'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('streaming.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->disable == 'on'){
            $request['disable'] = true;
        } else {
            $request['disable']  = false;
        }
        $streaming = Streaming::create($request->all());
        return redirect()->back()->with('success', 'Streaming keyword has been dded.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $streaming = Streaming::findOrFail($id);
        return view('streaming.edit', compact('streaming'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->disable == 'on'){
            $request->disable = true;
        } else {
            $request->disable = false;
        }

        $streaming = Streaming::findOrFail($id);
        $streaming->str = $request->str;
        $streaming->disable = $request->disable;
        $streaming->save();
        return redirect()->back()->with('success', 'Streaming keyword has been updated.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $streaming = Streaming::findOrFail($id);
        $streaming->delete();
        return redirect()->to('/streaming')->with('success', 'Streaming keyword has been deleted.');
    }

    public function status($id)
    {
        $streaming = Streaming::findOrFail($id);
        if ($streaming->disable){
            $streaming->disable = false;
        }
        else {
            $streaming->disable = true;
        }
        $streaming->save();
        return redirect()->to('/streaming');

    }
}