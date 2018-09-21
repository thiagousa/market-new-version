<?php

use Illuminate\Database\Seeder;
use App\User;
use App\PagesAdmin;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $pagesAdmin = PagesAdmin::all();

        $inserts = [];

        foreach ($users as $user){
            foreach ($pagesAdmin as $page){
                array_push($inserts, ['userId' => $user->id, 'pageAdminId' => $page->pagesAdminId, 'access' => 1, 'add' => 1, 'edit' => 1, 'delete' => 1]);
            }
        }

        DB::table('permissions')->insert($inserts);
    }
}
