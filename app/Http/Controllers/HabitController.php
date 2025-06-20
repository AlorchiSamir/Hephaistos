<?php

namespace App\Http\Controllers;

use App\Http\Requests\HabitRequest;
use App\Http\Resources\HabitResource;
use App\Models\Habit;
use Illuminate\Http\Request;

class HabitController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        return view('habits.index');
    }

    public function json()
    {
        return HabitResource::collection(Habit::all());
    }

    public function form(Habit $habit)
    {
        return view('habits.form', ['habit' => new HabitResource($habit)]);
    }

    public function update(Request $request)
    {
        $habit = Habit::find($request->id);
        $values = $request->all()['values'];
        if(isset($values['name']))
        {
            $habit->name = $values['name'];
        }
        if(isset($values['description']))
        {
            $habit->description = $values['description'];
        }
        return $habit->save();
    }

    public function store(HabitRequest $request)
    {

        $values = $request->all();
        $values['countable'] = (isset( $values['countable'])) ? true : false;
        $habit = Habit::create($values);
    }
}
