<?php

use Illuminate\Database\Seeder;
use App\Sector;

class SectorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //DB::table('sectors')->truncate();
        
        Sector::create([
            'name' => 'Setor 01'

        ]);
        
        // Exibe uma informação no console durante o processo de seed
        $this->command->info('Sector Default created');
    }
}
