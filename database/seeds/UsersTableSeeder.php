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
        $this->createDemoUser();
        $this->createAdminUser();
    }

    protected function createDemoUser()
    {
        DB::table('users')->insert([
            'name' => 'demo',
            'email' => 'demo@demo.com',
            'password' => bcrypt('demo'),
        ]);
    }

    protected function createAdminUser()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@demo.com',
            'password' => bcrypt('admin'),
            'is_admin' => 1
        ]);
    }
}
