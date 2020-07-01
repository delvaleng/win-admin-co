<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\RolUser;

class RolUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RolUser::create([
          'role_id'  => 1,
          'user_id'  => 1,
        ]);
        RolUser::create([
          'role_id'  => 2,
          'user_id'  => 1,
        ]);
    }
}
