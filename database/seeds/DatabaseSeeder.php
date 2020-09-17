<?php

use Illuminate\Database\Seeder;
use App\Admin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::where('name',"admin")->first();
        if (!$admin){
            $admin = Admin::create([
                'name' => 'admin',
                'password' => bcrypt('1234')
            ]);
        }
    }
}
