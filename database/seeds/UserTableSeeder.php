<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('user')->insert([
            'username' => 'admin',
            'name' => 'Administrator',
            'password' => bcrypt('123456'),
            'role_id' => '1'
        ]);  
    }

}
