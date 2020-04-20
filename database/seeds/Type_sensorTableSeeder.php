<?php

use Illuminate\Database\Seeder;
use App\Type_sensor;

class Type_sensorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('type_sensors')->truncate();
        
        Type_sensor::create([
            'name' => 'Geladeira Padrão', 
            'description'  => 'Uso Geral',
            'max_temp' => '4',
            'min_temp' => '-4'
        ]);
        
        // Exibe uma informação no console durante o processo de seed
        $this->command->info('type Sensor Default created');
        
    }
}
