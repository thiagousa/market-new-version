<?php

use Illuminate\Database\Seeder;

class PagesAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pagesAdmin')->insert([
            [
                'pagesAdminId'  => 'promoters',
                'title'         => 'Promoters',
                'icon'          => 'si si-graduation',
                'sortorder'     => 1
            ],
            [
                'pagesAdminId'  => 'typeCustomers',
                'title'         => 'Type Customers',
                'icon'          => 'si si-list',
                'sortorder'     => 2
            ],
            [
                'pagesAdminId'  => 'customers',
                'title'         => 'Customers',
                'icon'          => 'si si-login',
                'sortorder'     => 3
            ],
            [
                'pagesAdminId'  => 'categories',
                'title'         => 'Categories',
                'icon'          => 'si si-note',
                'sortorder'     => 4
            ],
            [
                'pagesAdminId'  => 'employees',
                'title'         => 'Employees',
                'icon'          => 'si si-user-following',
                'sortorder'     => 5
            ],
            [
                'pagesAdminId'  => 'products',
                'title'         => 'Products',
                'icon'          => 'si si-social-dropbox',
                'sortorder'     => 6
            ],
            [
                'pagesAdminId'  => 'orders',
                'title'         => 'Orders',
                'icon'          => 'si si-arrow-up',
                'sortorder'     => 7
            ],
            [
                'pagesAdminId'  => 'inventories',
                'title'         => 'Inventories',
                'icon'          => 'si si-arrow-up',
                'sortorder'     => 8
            ],
            [
                'pagesAdminId'  => 'losses',
                'title'         => 'Losses',
                'icon'          => 'si si-arrow-down',
                'sortorder'     => 9
            ],
            [
                'pagesAdminId'  => 'drawers',
                'title'         => 'Drawers',
                'icon'          => 'si si-arrow-down',
                'sortorder'     => 10
            ],
            [
                'pagesAdminId'  => 'cashiers',
                'title'         => 'Cashiers',
                'icon'          => 'si si-arrow-down',
                'sortorder'     => 11
            ],
            [
                'pagesAdminId'  => 'settings',
                'title'         => 'Settings',
                'icon'          => 'si si-settings',
                'sortorder'     => 12
            ],
            [
                'pagesAdminId'  => 'profile',
                'title'         => 'Profile',
                'icon'          => 'si si-key',
                'sortorder'     => 13
            ],
            [
                'pagesAdminId'  => 'users',
                'title'         => 'Users',
                'icon'          => 'si si-users',
                'sortorder'     => 14
            ]
        ]);
    }
}
