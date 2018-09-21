<?php

use Illuminate\Database\Seeder;

class DrawersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('drawers')->delete();
        
        \DB::table('drawers')->insert(array (
            0 => 
            array (
                'drawerId' => 1,
                'cashierId' => 0,
                'number' => 6,
                'value' => 240.0,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2018-07-14 18:47:15',
                'updated_at' => '2018-07-30 21:11:18',
            ),
            1 => 
            array (
                'drawerId' => 2,
                'cashierId' => 0,
                'number' => 2,
                'value' => 500.0,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2018-07-14 18:47:15',
                'updated_at' => '2018-07-31 20:48:00',
            ),
            2 => 
            array (
                'drawerId' => 3,
                'cashierId' => 3,
                'number' => 3,
                'value' => 500.0,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2018-07-14 18:47:15',
                'updated_at' => '2018-07-14 18:47:15',
            ),
            3 => 
            array (
                'drawerId' => 4,
                'cashierId' => 4,
                'number' => 4,
                'value' => 500.0,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2018-07-14 18:47:15',
                'updated_at' => '2018-07-14 18:47:15',
            ),
            4 => 
            array (
                'drawerId' => 5,
                'cashierId' => 5,
                'number' => 5,
                'value' => 500.0,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2018-07-14 18:47:15',
                'updated_at' => '2018-07-14 18:47:15',
            ),
            5 => 
            array (
                'drawerId' => 6,
                'cashierId' => 6,
                'number' => 1,
                'value' => 500.0,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2018-07-14 18:47:15',
                'updated_at' => '2018-07-14 18:47:15',
            ),
            6 => 
            array (
                'drawerId' => 7,
                'cashierId' => 7,
                'number' => 7,
                'value' => 500.0,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2018-07-14 18:47:15',
                'updated_at' => '2018-07-14 18:47:15',
            ),
            7 => 
            array (
                'drawerId' => 8,
                'cashierId' => 8,
                'number' => 8,
                'value' => 500.0,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2018-07-14 18:47:15',
                'updated_at' => '2018-07-14 18:47:15',
            ),
            8 => 
            array (
                'drawerId' => 9,
                'cashierId' => 9,
                'number' => 9,
                'value' => 500.0,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2018-07-14 18:47:15',
                'updated_at' => '2018-07-14 18:47:15',
            ),
            9 => 
            array (
                'drawerId' => 10,
                'cashierId' => 10,
                'number' => 10,
                'value' => 500.0,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2018-07-14 18:47:15',
                'updated_at' => '2018-07-14 18:47:15',
            ),
        ));
        
        
    }
}