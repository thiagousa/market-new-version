<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'title' => 'Goianão Supermercado',
                'email' => 'contact@goianaosupermercado.com',
                'favicon' => 'favicon.png',
                'avatar' => 'avatar.png',
                'appleTouchIcon' => 'apple-touch-icon.png',
                'maintenance' => 0
            ]
        ]);
    }
}
