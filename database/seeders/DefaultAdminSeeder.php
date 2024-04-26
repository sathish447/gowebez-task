<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;

class DefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'M.S.Dhoni';
        $user->email = 'admin@example.com';
        $user->password =  bcrypt('123456');

        $user->save();
    }
}
