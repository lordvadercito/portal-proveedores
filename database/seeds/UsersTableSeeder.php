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
            'name' => 'Administrador',
            'email' => 'admin@mail.com',
            'password' => Hash::make('frigoPico2!'),
            'rol' => \App\User::UPLOADER,
        ]);

        DB::table('users')->insert([
            'name' => 'Frigorifico Gorina',
            'email' => 'gorina@pico.com',
            'password' => Hash::make('gor1n4!'),
            'rol' => \App\User::DOWNLOADER,
        ]);
    }
}
