<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warning;
use App\Sector;
use App\Enterprise;
use App\Sensor;
use App\Measurement;

class MeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        
    }

    public function status(){

        

        $w= Warning::where('is_justified', '=', null)->with(array(
            'measurement'=>function($q){
                $q->with(array(
                    'sensor'=>function($q){
                        $q->with(array(
                            'sector',
                            'enterprise',
                            'type_sensor'
                        ));
                    }
                ));
            }
        ))->orderBy('created_at')->get();


        return view('measurement.status', compact('w'));


    }
    public function liveIndex()
    {
        $sectors = Sector::all();
        $enterprises = Enterprise::all();

        return view('measurement.live', compact('sectors', 'enterprises'));
    }

    public function plotSector(Request $request){

        $empresa_id = $request->empresa_id;
        $setor_id = $request->setor_id;

        $sensors = Sensor::where('sector_id', $setor_id)
        ->where('enterprise_id', $empresa_id)->with('type_sensor')->get();

        return view('sector.plot', compact('sensors'));




    }
    public function index()
    {
        
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
