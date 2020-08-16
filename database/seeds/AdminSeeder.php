<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::insert([
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('12345678'),
                'is_super_admin' => '1'
            ],
        ]);
    }
}
