<?php

namespace App\Http\Controllers;

use App\Keyword;
use Illuminate\Http\Request;

class KeywordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $keywords = Keyword::paginate(15);
        return view('keyword.index', compact('keywords'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('keyword.add');
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
        $keyword = Keyword::create($request->all());
        return redirect()->back()->with('success', 'Keyword Added.');
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
        $keyword = Keyword::findOrFail($id);
        return view('keyword.edit', compact('keyword'));
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

        $keyword = Keyword::findOrFail($id);
        $keyword->str = $request->str;
        $keyword->disable = $request->disable;
        $keyword->save();
        return redirect()->back()->with('success', 'Keyword Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $keyword = Keyword::findOrFail($id);
        $keyword->delete();
        return redirect()->to('/keyword')->with('success', 'Keyword Deleted.');
    }

    public function status($id)
    {
        $keyword = Keyword::findOrFail($id);
        if ($keyword->disable){
            $keyword->disable = false;
        }
        else {
            $keyword->disable = true;
        }
        $keyword->save();
        return redirect()->to('/keyword');

    }
}