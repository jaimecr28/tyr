<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warning;
use App\Measurement;
use App\Sensor;

class WarningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        date_default_timezone_set('America/Sao_Paulo');
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
        $ids = explode(',',$request->ids);
        $justification= $request->justifica;
        $started_at = $request->started_at." ".$request->started_time;
        $end_at = $request->end_at." ".$request->end_time;

        //$ids = $request->ids;

        $warns = Warning::find($ids);

        foreach ($warns as $warn) {
            $warn->is_justified = "1";
            $warn->justification = $justification;
            $warn->started_at = $started_at;
            $warn->end_at = $end_at;
            $warn->updated_at = date('Y-m-d H:i:s');
            $warn->save();
         }
        
        $data = json_encode($warns);

        if ($warns) {

            return response()->json($data, 200);
        } else {
            return response()->json($data, 404);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medidas = Measurement::where('sensor_id',$id)->orderBy('datetime', 'DESC')->with('sensor.type_sensor')->limit(100)->get();

        $medidas_clean = array();

        if (count($medidas)>0) {

            $data = json_encode($medidas);
            return response()->json($data, 200);
        } else {
            $erro = array(
                'error'=>'Sem dados disponiveis'
            );
            $data = json_encode($erro);
            return response()->json($data, 404);
        }

        
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
