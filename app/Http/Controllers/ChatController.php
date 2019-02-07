<?php

namespace App\Http\Controllers;

use App\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chat = Chat::OrderBy('id','desc')->paginate(15);
        return view('chat.index',compact('chat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('chat.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'keyword' => 'required',
            'reply' => 'required|max:140',
        ]);

        if ($request->disable == 'on'){
            $request['disable'] = true;
        } else {
            $request['disable']  = false;
        }
        $request['user_id'] = Auth::user()->id;
        $chat = Chat::create($request->all());
        return redirect()->back()->with('success','Chat keyword has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chat = Chat::findOrFail($id);
        return view('chat.edit',compact('chat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'keyword' => 'required',
            'reply' => 'required|max:140',
        ]);

        if ($request->disable == 'on'){
            $request->disable = true;
        } else {
            $request->disable = false;
        }

        $chat = Chat::findOrFail($id);
        $chat->keyword = $request->keyword;
        $chat->reply = $request->reply;
        $chat->disable = $request->disable;
        $chat->save();
        return redirect()->back()->with('success','Chat keyword has been updated');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $chat = Chat::findOrFail($id);
        $chat->delete();
        return redirect()->to('/chat')->with('success','Chat keyword has been deleted');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function status($id)
    {
        $chat = Chat::findOrFail($id);
        if ($chat->disable){
            $chat->disable = false;
        }
        else {
            $chat->disable = true;
        }
        $chat->save();
        return redirect()->to('/chat');

    }
}
