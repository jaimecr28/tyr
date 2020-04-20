<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('users')->truncate();
        
        User::create([
            'email' => 'admin@admin.com', 
            'name'  => 'Administrador',
            'password' => bcrypt('admin'),
            'is_permission' => '2'
        ]);
        
        // Exibe uma informação no console durante o processo de seed
        $this->command->info('User Admin created');
    }
}
