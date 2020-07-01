<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create([
        'username'     => 'admin',
        'ndocumento'   => '0000001',
        'first_name'   => mb_strtoupper('ADMINISTRADOR'),
        'last_name'    => mb_strtoupper('WINTECNOLOGIES'),
        'phone'        => '00000000',
        'email'        => 'sistemas@winhold.net',
        'password'     => Hash::make('12345678'),
        'country_id'   => 1,
        'employe'      => true,
     ]);
    }
}
