<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TypeCustomersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('typeCustomers')->insert([
            [
                'name' => 'Employees',
                'tax' => 15,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Atacado',
                'tax' => 20,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Bakery',
                'tax' => 50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Restaurant',
                'tax' => 50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
