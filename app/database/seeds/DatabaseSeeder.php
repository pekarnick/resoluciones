<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('TweetsTableSeeder');
		$this->call('ResolucionsTableSeeder');
		$this->call('TiposTableSeeder');
		$this->call('PersmisionsTableSeeder');
		$this->call('RolesTableSeeder');
		$this->call('PermissionsTableSeeder');
		$this->call('TagsTableSeeder');
		$this->call('NombresTableSeeder');
	}

}