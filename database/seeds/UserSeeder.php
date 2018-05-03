<?php

use Illuminate\Database\Seeder;
use App\Models\Player;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Player::create([
            'name'     => 'Maroš',
            'surname'  => 'Karas',
            'email'    => 'admin@shpinec.cz',
            'password' => Hash::make('qwerty'),
            'is_admin' => true
        ]);
    }
}
