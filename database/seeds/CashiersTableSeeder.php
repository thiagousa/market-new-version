<?php

use Illuminate\Database\Seeder;

class CashiersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cashiers')->delete();
        
        \DB::table('cashiers')->insert(array (
            0 => 
            array (
                'cashierId' => 1,
                'drawerId' => 1,
                'userId' => 1,
                'value_inicial' => 500.0,
                'value_final' => 500.0,
                'type' => 1,
                'deleted_at' => NULL,
                'created_at' => '2018-07-17 21:24:59',
                'updated_at' => '2018-07-31 20:50:51',
            ),
            1 => 
            array (
                'cashierId' => 2,
                'drawerId' => 2,
                'userId' => 1,
                'value_inicial' => 500.0,
                'value_final' => 500.0,
                'type' => 1,
                'deleted_at' => NULL,
                'created_at' => '2018-07-17 21:24:59',
                'updated_at' => '2018-07-31 20:48:00',
            ),
            2 => 
            array (
                'cashierId' => 3,
                'drawerId' => 3,
                'userId' => 1,
                'value_inicial' => 500.0,
                'value_final' => 0.0,
                'type' => 1,
                'deleted_at' => NULL,
                'created_at' => '2018-07-17 21:24:59',
                'updated_at' => '2018-07-17 21:24:59',
            ),
            3 => 
            array (
                'cashierId' => 4,
                'drawerId' => 4,
                'userId' => 1,
                'value_inicial' => 500.0,
                'value_final' => 0.0,
                'type' => 1,
                'deleted_at' => NULL,
                'created_at' => '2018-07-17 21:24:59',
                'updated_at' => '2018-07-30 20:35:39',
            ),
            4 => 
            array (
                'cashierId' => 5,
                'drawerId' => 5,
                'userId' => 1,
                'value_inicial' => 500.0,
                'value_final' => 0.0,
                'type' => 1,
                'deleted_at' => NULL,
                'created_at' => '2018-07-17 21:24:59',
                'updated_at' => '2018-07-17 21:24:59',
            ),
            5 => 
            array (
                'cashierId' => 6,
                'drawerId' => 6,
                'userId' => 1,
                'value_inicial' => 500.0,
                'value_final' => 0.0,
                'type' => 1,
                'deleted_at' => NULL,
                'created_at' => '2018-07-17 21:24:59',
                'updated_at' => '2018-07-17 21:24:59',
            ),
            6 => 
            array (
                'cashierId' => 7,
                'drawerId' => 7,
                'userId' => 1,
                'value_inicial' => 500.0,
                'value_final' => 0.0,
                'type' => 1,
                'deleted_at' => NULL,
                'created_at' => '2018-07-17 21:24:59',
                'updated_at' => '2018-07-30 20:35:47',
            ),
            7 => 
            array (
                'cashierId' => 8,
                'drawerId' => 8,
                'userId' => 1,
                'value_inicial' => 500.0,
                'value_final' => 0.0,
                'type' => 1,
                'deleted_at' => NULL,
                'created_at' => '2018-07-17 21:24:59',
                'updated_at' => '2018-07-17 21:24:59',
            ),
            8 => 
            array (
                'cashierId' => 9,
                'drawerId' => 9,
                'userId' => 1,
                'value_inicial' => 500.0,
                'value_final' => 0.0,
                'type' => 1,
                'deleted_at' => NULL,
                'created_at' => '2018-07-17 21:24:59',
                'updated_at' => '2018-07-17 21:24:59',
            ),
            9 => 
            array (
                'cashierId' => 10,
                'drawerId' => 10,
                'userId' => 1,
                'value_inicial' => 500.0,
                'value_final' => 0.0,
                'type' => 1,
                'deleted_at' => NULL,
                'created_at' => '2018-07-17 21:24:59',
                'updated_at' => '2018-07-17 21:24:59',
            ),
        ));
        
        
    }
}