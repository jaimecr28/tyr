<?php

use Illuminate\Database\Seeder;
use App\Report;

class ReportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //DB::table('sensors')->truncate();
        
        Report::create([
            'name' => 'Relatório Geral', 
            'path'  => 'public'
        ]);
        
        // Exibe uma informação no console durante o processo de seed
        $this->command->info('Report Default created');
    }
}
