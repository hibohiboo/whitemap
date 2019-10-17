<?php

use Illuminate\Database\Seeder;

class RaceTableSheeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $race = [
            'name' => '人間'
        ];
        DB::table('race')->insert($race);
    }
}
