<?php

namespace App\Http\Controllers;

use App\Http\Resources\DayResource;
use App\Models\Day;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        $days = Day::all();
        return view('log.index', ['days' => $days]);
    }

    public function json()
    {
        return DayResource::collection(Day::orderBy('day', 'DESC')->get());
    }

    public function form($day)
    {
        $day = Day::find($day);
        return view('log.form', ['day' => $day]);
    }

    public function store(Request $request)
    {
        $values = $request->all();
        $day = Day::find($values['day_id']);
        $day->log = $values['log'];
        $day->save();
    }
}
