<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserTableSeeder::class,
            Type_sensorTableSeeder::class,
            SectorTableSeeder::class,
            EnterpriseTableSeeder::class,
            ReportTableSeeder::class,
            SensorTableSeeder::class,
            ]);
    }
}
