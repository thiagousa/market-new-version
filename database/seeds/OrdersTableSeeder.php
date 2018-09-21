<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Orders;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Orders::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Orders::insert([
            [
                'ordersId' => 1,
                'promotersId' => 1,
                'finalValue' => 5689,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ordersId' => 2,
                'promotersId' => 2,
                'finalValue' => 84567,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ordersId' => 3,
                'promotersId' => 3,
                'finalValue' => 5647,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ordersId' => 4,
                'promotersId' => 4,
                'finalValue' => 4567,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ordersId' => 5,
                'promotersId' => 5,
                'finalValue' => 4567,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ordersId' => 6,
                'promotersId' => 6,
                'finalValue' => 8907,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ordersId' => 7,
                'promotersId' => 7,
                'finalValue' => 78756,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ordersId' => 8,
                'promotersId' => 8,
                'finalValue' => 6543,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ordersId' => 9,
                'promotersId' => 1,
                'finalValue' => 5678,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ordersId' => 10,
                'promotersId' => 1,
                'finalValue' => 3421,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}