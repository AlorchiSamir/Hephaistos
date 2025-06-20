<?php

namespace App\Console\Commands;

use App\Models\Day;
use Carbon\Carbon;
use Illuminate\Console\Command;

class FillDays extends Command
{
    private $db = null;
    private $mysql = null;
    private $date = null;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'day:fill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Créé les jours manquants jusqu'à aujourd'hui";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info("Fill Days");
        $this->info("======================");
        $this->info("");

        $continue = true;
        $lastday = Day::orderBy('day', 'DESC')->first();
        $today = Carbon::today()->toDateString();

        if(is_null($lastday))
        {
            $lastday = Carbon::createFromFormat('Y-m-d', Day::FIRSTDAY)->subDays(1)->toDateString();
        }
        else
        {
            $lastday = $lastday->day;
        }
        while($continue)
        {
            $lastday = Carbon::createFromFormat('Y-m-d', $lastday)->addDays(1)->toDateString();
            if($lastday == $today)
            {
                $continue = false;
            }
            else
            {
                $exist = Day::where('day', '=', $lastday)->orderBy('day', 'DESC')->first();
                if(is_null($exist))
                {
                    $day = new Day();
                    $day->day = $lastday;
                    $day->save();
                    $this->info($lastday);
                }

            }
        }


    }


}

