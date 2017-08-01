<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $json = File::get("database/data/users.json");
        $data = json_decode($json);

        foreach($data->users as $obj) {
            DB::table('users')->insert(array(
                "username"  => $obj->username,
                "password"  => bcrypt("1234"),
                "role"      => $obj->role
            ));
        }
    }
}
