<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('admins')->delete();

    	$admin = Admin::create([
    		'email'    => 'admin@banteninformationproduct.com',
    		'name'     => 'Admin',
    		'username' => 'admin_bip',
    		'role'	   => 1,
    		'is_active'=> 1,
    		'image'    => '',
        	'password' => Hash::make('admin'),
    	]);
    }
}
