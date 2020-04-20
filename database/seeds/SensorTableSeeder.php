<?php

use Illuminate\Database\Seeder;
use App\Sensor;

class SensorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('sensors')->truncate();
        
        Sensor::create([
            'name' => 'Sensor S01', 
            'brand_freeze'  => 'Marca Generica',
            'model_freeze' => 'Modelo Generico',
            'type_sensor_id' => '1',
            'sector_id' => '1',
            'enterprise_id' => '1',
        ]);
        
        // Exibe uma informação no console durante o processo de seed
        $this->command->info('Sensor Default created');
    }
}
