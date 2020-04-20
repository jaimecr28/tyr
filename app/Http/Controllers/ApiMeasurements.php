<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Measurement;
use App\Sensor;
use App\Warning;

class ApiMeasurements extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request){

        date_default_timezone_set('America/Sao_Paulo');

        $sensor_id = $request->sensor_id;
        $temperatura = floatval($request->temperature);
        $sensor = Sensor::with('type_sensor')->find($sensor_id);
        $max = floatval($sensor->type_sensor->max_temp);
        $min = floatval($sensor->type_sensor->min_temp);
        $medida = new Measurement;

        $medida->datetime = date('Y-m-d H:i:s');
        $medida->temperature = $temperatura;
        $medida->sensor_id = $sensor_id;
        
        if (date('H')>12) {
            $medida->afternoon = '1';
        } else {
            $medida->afternoon = '0';
        }
        $medida->save();
        
        if ($temperatura > $max) {

            $warning = new Warning;
            $warning->measurement_id = $medida->id;
            $warning->motive = "Temperatura Superior ao Máximo estabelecido";
            $warning->sensor_id = $sensor_id;
            
            $medidaW = Measurement::find($medida->id);
            $warning->measurement()->associate($medida)->save();

            $medidaW->warning_id = $warning->id;

            $medidaW->save();

        }
        elseif ($temperatura < $min) {

            $warning = new Warning;
            $warning->measurement_id = $medida->id;
            $warning->motive = "Temperatura Inferior ao Mínimo estabelecido";
            $warning->sensor_id = $sensor_id;
            
            $medidaW = Measurement::find($medida->id);
            $warning->measurement()->associate($medida)->save();

            $medidaW->warning_id = $warning->id;
            
            $medidaW->save();

        }

        $data = json_encode($medida);

        return response()->json($data, 200);

    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
