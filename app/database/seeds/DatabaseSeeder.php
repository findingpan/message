<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->insert([
				['name'=>'admin','password'=>Hash::make('1'),'is_admin'=>'1'],
				['name'=>'user','password'=>Hash::make('1'),'is_admin'=>'0']
			]);
	}

}
