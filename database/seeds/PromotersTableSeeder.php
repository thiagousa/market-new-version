<?php

use Illuminate\Database\Seeder;

class PromotersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('promoters')->delete();
        
        \DB::table('promoters')->insert(array (
            0 => 
            array (
                'promotersId' => 1,
                'name' => 'Pedro & Thiago',
                'email' => 'pt@gmail.com',
                'phone' => '6565656666',
                'cellphone' => '6565656666',
                'address' => 'wWest Georgia',
                'city' => 'Atlanta',
                'state' => 'GA',
                'country' => 'US',
                'zipcode' => '30380',
                'sponsor' => 'Thiago',
                'deleted_at' => NULL,
                'created_at' => '2018-06-13 14:52:20',
                'updated_at' => '2018-06-13 14:52:20',
            ),
            1 => 
            array (
                'promotersId' => 2,
                'name' => 'Frutos do MAr',
                'email' => 'fm@gmail.com',
                'phone' => '67858962345',
                'cellphone' => '67858962345',
                'address' => 'West Georgia',
                'city' => 'Marietta',
                'state' => 'GA',
                'country' => 'US',
                'zipcode' => '30380',
                'sponsor' => 'Nicole',
                'deleted_at' => NULL,
                'created_at' => '2018-06-13 14:56:52',
                'updated_at' => '2018-06-13 14:56:52',
            ),
            2 => 
            array (
                'promotersId' => 3,
                'name' => 'Maria das Almas',
                'email' => 'pta@gmail.com',
                'phone' => '6785807165',
                'cellphone' => '6894567',
                'address' => 'West PLaza',
                'city' => 'Atlnta',
                'state' => 'GA',
                'country' => 'US',
                'zipcode' => '45545554',
                'sponsor' => 'Miara',
                'deleted_at' => NULL,
                'created_at' => '2018-06-13 15:06:04',
                'updated_at' => '2018-06-13 15:06:04',
            ),
            3 => 
            array (
                'promotersId' => 4,
                'name' => 'Oregano',
                'email' => 'catarina@g.com',
                'phone' => '6784125687',
                'cellphone' => '6784125687',
                'address' => 'West Lest',
                'city' => 'Marietta',
                'state' => 'GA',
                'country' => 'US',
                'zipcode' => '30380',
                'sponsor' => 'Catarina',
                'deleted_at' => NULL,
                'created_at' => '2018-06-13 15:10:41',
                'updated_at' => '2018-06-13 15:10:41',
            ),
            4 => 
            array (
                'promotersId' => 5,
                'name' => 'Vanessa',
                'email' => 'vanessa@gmail.com',
                'phone' => '678945642',
                'cellphone' => '678945642',
                'address' => 'West granite ',
                'city' => 'Atlanta',
                'state' => 'GA',
                'country' => 'US',
                'zipcode' => '30380',
                'sponsor' => 'Wanessa',
                'deleted_at' => NULL,
                'created_at' => '2018-06-13 15:11:24',
                'updated_at' => '2018-06-13 15:11:24',
            ),
            5 => 
            array (
                'promotersId' => 6,
                'name' => 'Wanessa',
                'email' => 'w@jk.com',
                'phone' => '67845987214',
                'cellphone' => '67845987214',
                'address' => 'North Georgia',
                'city' => 'Altanta',
                'state' => 'GA',
                'country' => 'US',
                'zipcode' => '30380',
                'sponsor' => 'Wanessa',
                'deleted_at' => NULL,
                'created_at' => '2018-06-13 15:14:11',
                'updated_at' => '2018-06-13 15:14:11',
            ),
            6 => 
            array (
                'promotersId' => 7,
                'name' => 'Raquel',
                'email' => 'raquel@gmail.com',
                'phone' => '6789564123',
                'cellphone' => '6789564123',
                'address' => 'Rua dos Desejos 3256',
                'city' => 'Marietta',
                'state' => 'GA',
                'country' => 'US',
                'zipcode' => '685945',
                'sponsor' => 'Wanessa',
                'deleted_at' => NULL,
                'created_at' => '2018-06-13 15:14:58',
                'updated_at' => '2018-06-13 15:14:58',
            ),
            7 => 
            array (
                'promotersId' => 8,
                'name' => 'Teixeira 7 Silva',
                'email' => 'silva@gaf.com',
                'phone' => '698745623',
                'cellphone' => '654785123',
                'address' => 'Rua Street Hoje',
                'city' => 'Atlanta',
                'state' => 'GA',
                'country' => 'US',
                'zipcode' => '30380',
                'sponsor' => 'Chico Mineiro',
                'deleted_at' => NULL,
                'created_at' => '2018-06-13 15:16:21',
                'updated_at' => '2018-06-13 15:16:21',
            ),
            8 => 
            array (
                'promotersId' => 9,
                'name' => 'Mesezes e Jose',
                'email' => 'mj@gmail.com',
                'phone' => '67841235',
                'cellphone' => '67841235',
                'address' => 'West Jore',
                'city' => 'Atlanta',
                'state' => 'GA',
                'country' => 'US',
                'zipcode' => '35689',
                'sponsor' => 'Tania',
                'deleted_at' => NULL,
                'created_at' => '2018-06-13 15:18:26',
                'updated_at' => '2018-06-13 15:18:26',
            ),
        ));
        
        
    }
}