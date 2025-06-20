<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HabitSeeder extends Seeder
{
    const FIElDS = [
        'Abstinence' => 'string',
        'Audio Dev Perso' => 'string',
        'Boisson Saine' => 'string',
        'Bouffe Saine' => 'string',
        'Lecture' => 'string',
        'Lecture (DP)' => 'string',
        'Apprentissage' => 'string',
        'Révision' => 'string',
        'Marche' => 'string',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(self::FIElDS as $field => $type)
        {
            DB::table('fields')->insert([
                'name' => $field,
                'description' => $type
            ]);
        }
    }
}
