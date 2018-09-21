<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Bruno Martins',
                'email' => 'hello@brunomartins.com',
                'password' => '$2y$10$PTm5rB51N9r8FxTnEG6.Fus.zr6QcRxp2bCevPF8gIT94so3KO3By',
                'remember_token' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2018-07-17 21:24:58',
                'updated_at' => '2018-07-17 21:24:58',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Thiago dos Santos',
                'email' => 'thiago@thiagodsantos.com',
                'password' => '$2y$10$y5xT6r0Tgvbwc9z47ypZluhZlVMrCa.R9bF4amr2nU2cLsswLFWYy',
                'remember_token' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2018-07-17 21:24:59',
                'updated_at' => '2018-07-17 21:24:59',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Administrador',
                'email' => 'contact@goianaosupermercado.com',
                'password' => '$2y$10$mT/YgKwfcozAspSeJjDC8uT8g.QeWUTrJ/./v/F0nqKb.3hdVXbfW',
                'remember_token' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2018-07-17 21:24:59',
                'updated_at' => '2018-07-17 21:24:59',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Caixa Teste',
                'email' => 'caixateste@goianao.com.br',
                'password' => '$2y$10$/5YHRZ6ZWHOffSkJETrpMuzNhNOnW5YEf3P9dvNyMp.ONKBikkbVm',
                'remember_token' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2018-07-17 23:20:14',
                'updated_at' => '2018-07-17 23:20:14',
            ),
        ));
        
        
    }
}