<?php

use Illuminate\Database\Seeder;

class CamerasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cameras')->insert([
        	[
        		'name' => 'Sin Camara'
        	]
        ]);
    }
}
