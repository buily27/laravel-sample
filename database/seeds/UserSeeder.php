<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin@gmail.com',
            'password' => Hash::make(123456),
            'phone' => '0234566543',
            'name' => 'Admin',
            'dob' => '2000/01/01',
            'image' => '',
            'address' => 'Hà Nội',
            'worked_at' => '2022/01/01',
            'work_status' => config('common.IS_WORK'),
            'is_first_login' => config('common.IS_FIRST_LOGIN'),
            'role_id' => config('common.IS_MANAGEMENT'),
            'is_admin' => config('common.IS_ADMIN'),
            'department_id' => 1,
        ]);
    }
}
