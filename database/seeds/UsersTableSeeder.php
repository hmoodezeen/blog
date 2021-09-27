<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $user = User::where('email',"hmoode.zeen6630@gmail.com")->first();
        $user = DB::table('users')->where('email', "hmoode.zeen6630@gmail.com")->first();

        if (!$user) {
            User::create([
                'name' => 'Zain',
                'email' => 'hmoode.zeen6630@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 'admin'
            ]);
        }
    }
}
