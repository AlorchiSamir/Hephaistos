<?php

namespace App\Http\Controllers;

use App\Http\Resources\HabitResource;
use App\Models\Habit;
use App\Models\Habitday;
use App\Http\Requests\HabitRequest;
use Illuminate\Http\Request;

class HabitDayController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        return view('habitday.index');
    }

    public function json()
    {
        return HabitResource::collection(Habit::all());
    }

    public function form(Habit $habit)
    {
        return view('habitday.form', ['habits' => HabitResource::collection(Habit::all())]);
    }

    public function view($day)
    {
        return view('habitday.view', ['day' => $day]);
    }

    public function view_json($day)
    {
        $datas = array();
        $habits = Habit::all();

        foreach($habits as $habit)
        {

            $habitday = Habitday::where('day_id', '=', $day)->where('habit_id', '=', $habit->id)->first();
            if(!is_null($habitday)){
                $active = true;
                $gold = ($habitday->gold == 1) ? true : false;
                $counter = $habitday->counter;
            }
            else{
                $gold = $active = false;
                $counter = '';
            }

            $object = [
                'id' => $habit->id,
                'name' => $habit->name,
                'counter' => $counter,
                'gold' => $gold,
                'active' => $active,
                'habit' => $habit
            ];
            array_push($datas, $object);
        }
        return json_encode($datas);
    }

    public function update($day, Request $request)
    {
        $values = $request->all();
        $habitday = Habitday::where('day_id', '=', $day)->where('habit_id', '=', $values['id'])->first();
        if(!is_null($habitday)){
            $active = 'true';
            $gold = $habitday->gold;
            $counter = $habitday->counter;
        }
        else{
            $counter = $gold = 0;
        }

        if(isset($values['values']['active']))
        {
            $active = $values['values']['active'];
        }
        elseif(isset($values['values']['gold']))
        {
            if($values['values']['gold'] == 'true'){
                $gold = 1;
                $active = 'true';
            }
            else{
                $gold = 0;
            }
        }
        elseif(isset($values['values']['counter']))
        {
            $counter = $values['values']['counter'];
            if($values['values']['counter'] > 0){
                $active = 'true';
            }
            else{
                $gold = 0;
            }
        }


        if($active == 'true')
        {
            if(is_null($habitday)){
                $habitday = new Habitday();
                $habitday->day_id = $day;
                $habitday->habit_id = $values['id'];
            }
            $habitday->gold = $gold;
            $habitday->counter = $counter;
            $habitday->save();
        }
        else
        {
            $habitday->delete();
        }
        return json_encode(['response' => 'ok']);

    }
}
