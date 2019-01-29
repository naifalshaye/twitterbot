<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $scheduled = Schedule::OrderBy('id','desc')->paginate(15);
        return view('schedule.index',compact('scheduled'));
    }

    public function create()
    {
        return view('schedule.add');
    }

    public function store(Request $request)
    {
        Schedule::create($request->all());
        return redirect()->back()->with('success', 'Schedule tweet is set.');
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('schedule.edit',compact('schedule'));
    }


    public function show($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('schedule.edit',compact('schedule'));
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->date = $request->date;
        $schedule->time = $request->time;
        $schedule->text = $request->text;
        $schedule->save();
        return redirect()->back()->with('success', 'Schedule tweet is updated.');
    }

    public function status($id)
    {
        $schedule = Schedule::findOrFail($id);
        if ($schedule->disable){
            $schedule->disable = false;
        }
        else {
            $schedule->disable = true;
        }
        $schedule->save();
        return redirect()->to('/schedule');

    }
}
