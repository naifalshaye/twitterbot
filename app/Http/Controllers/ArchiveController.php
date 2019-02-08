<?php

namespace App\Http\Controllers;

use App\Arachive;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function index()
    {
        $archive = Arachive::OrderBy('id','desc')->paginate(15);
        return view('archive.index', compact('archive'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('archive.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Arachive::count() > 9){
            return redirect()->back()->withErrors('You have exceeded the maximum number of keywords. Maximum 10 Keywords');
        }

        $this->validate($request, [
            'str' => 'required'
        ]);

        if ($request->disable == 'on'){
            $request['disable'] = true;
        } else {
            $request['disable']  = false;
        }

        $keywords = Arachive::where('disable', false)->pluck('str')->toArray();

        $getfields = preg_replace('/^\?/', '', explode('&', 'q=' . implode('+OR+',$keywords)));
        $params = array();
        foreach ($getfields as $field)
        {
            if ($field !== '')
            {
                list($key, $value) = explode('=', $field);
                $params[$key] = $value;
            }
        }
        $query = '?' . http_build_query($params, '', '&');
        $query = $query.'%2BOR%2B'.$request->str;
        $query_lentgh = mb_strlen($query, 'UTF-8');
        if ($query_lentgh >= 500){
            return redirect()->back()->withErrors('You have exceeded the maximum characters lentgh for all keywords');
        }

        $archive = Arachive::create($request->all());
        return redirect()->back()->with('success', 'Archive keyword has been added.');
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
        $archive = Arachive::findOrFail($id);
        return view('archive.edit', compact('archive'));
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
        $this->validate($request, [
            'str' => 'required'
        ]);

        if ($request->disable == 'on'){
            $request->disable = true;
        } else {
            $request->disable = false;
        }

        $archive = Arachive::findOrFail($id);
        $archive->str = $request->str;
        $archive->disable = $request->disable;
        $archive->save();
        return redirect()->back()->with('success', 'Archive keyword has been updated.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $archive = Arachive::findOrFail($id);
        $archive->delete();
        return redirect()->to('/archive')->with('success', 'Archive keyword has been deleted.');
    }

    public function status($id)
    {
        $archive = Arachive::findOrFail($id);
        if ($archive->disable){
            $archive->disable = false;
        }
        else {
            $archive->disable = true;
        }
        $archive->save();
        return redirect()->to('/archive');

    }
}