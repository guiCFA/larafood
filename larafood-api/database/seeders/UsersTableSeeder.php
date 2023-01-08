<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    User::create([
			'name'     => 'Guilherme Cristiano',
			'email'    => 'guilherme@gmail.com',
			'password' => bcrypt('123')
		]);
  }
}
