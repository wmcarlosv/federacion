<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	[
        		'name' => 'Carlos',
        		'last_name' => 'Vargas',
        		'email' => 'cvargas@frontuari.net',
        		'password' => bcrypt('Car2244los*'),
        		'camera_id' => 1,
        		'role' => 'administrador',
        		'partner_type' => 'activo',
        		'isactive' => true,
        		'entry_id' => 1,
        		'clasification' => 'mayorista',
        		'isappvisible' => true,
        		'phone' => '+584160984343',
        		'location_id' => 1,
        		'direction' => 'Urb San Jose 2',
        		'country' => 'Venezuela',
        		'city' => 'Araure'
        	]
        ]);
    }
}
