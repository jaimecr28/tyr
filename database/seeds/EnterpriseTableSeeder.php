<?php

use Illuminate\Database\Seeder;
use App\Enterprise;

class EnterpriseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('enterprises')->truncate();
        
        Enterprise::create([
            'name' => 'Matriz', 
            'is_parent'  => '1'

        ]);
        
        // Exibe uma informação no console durante o processo de seed
        $this->command->info('Enterprise Default created');
    }
}
