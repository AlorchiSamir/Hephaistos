<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Habit;

class DayResource extends JsonResource
{
    public function __construct($resource)
    {
        parent::__construct($resource);
        self::withoutWrapping();
    }

    public function toArray($request)
    {
        $nbr_habits = $this->habitsValidatedCount();
        $total_habits = Habit::habitCount();
        $log = (!is_null($this->log)) ? true : false;

        return [
            'id' => $this->id,
            'day' => $this->day,
            'protocole' => [
                'nbr_habits' => $this->habitsValidatedCount(),
                'total_habits' => Habit::habitCount(),
                'currentPrc' => $this->calculatePercent($nbr_habits, $total_habits)
            ],
            'url' => [
                'view' => route('habitday.view', ['day' => $this->id]),
            ],
            'log' => [
                'exist' => $log,
                'url' => route('log.form', ['day' => $this->id]),
            ]
        ];
    }

    private function calculatePercent($numerator, $denominator)
    {
        if($denominator <= 0)
        {
            return 0;
        }
        else
        {
            return ($numerator/$denominator)*100;
        }
    }
}
