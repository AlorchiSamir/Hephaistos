<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{
    protected $fillable = ['name', 'description', 'xp', 'countable'];

    static public function habitCount()
    {
        return Habit::count();
    }
}
