<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $fillable = ['day'];

    public $timestamps = false;

    const FIRSTDAY = '2022-03-01';

    public function habitsValidatedCount()
    {
        return Habitday::where('day_id', '=', $this->id)->count();
    }
}
