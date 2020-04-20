<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sensor;
use App\Type_sensor;
use App\Enterprise;
use App\Sector;


class SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sensores = Sensor::with('Enterprise','Sector', 'Type_sensor')->get();
        return view('sensor.list', compact('sensores'));
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
        $s = new Sensor;

        $request->validate([
            'name'=>'required',
            'type_sensor_id'=>'required',
            'sector_id'=>'required',
            'enterprise_id'=>'required'
        ]);

        $s->name = $request->input('name');
        $s->brand_freeze = $request->input('brand_freeze');
        $s->model_freeze = $request->input('model_freeze');
        $s->send_alert = $request->input('send_alert');
        $s->send_sms = $request->input('send_sms');
        $s->type_sensor_id = $request->input('type_sensor_id');
        $s->sector_id = $request->input('sector_id');
        $s->enterprise_id = $request->input('enterprise_id');

        if ($s->save()) {
            return redirect('/sensor')->with('success', 'Sensor Criado!');
        } else {
            return redirect('/sensor')->with('danger', 'Sensor não Criado!');
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
        $sensor = Sensor::with('Enterprise','Sector', 'Type_sensor')->find($id);
        $type_sensors = Type_sensor::all();
        $enterprises = Enterprise::all();
        $sectors = Sector::all();
        return view('sensor.edit', compact('sensor','type_sensors', 'enterprises', 'sectors'));
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

        $s = Sensor::find($id);

        // $request->validate([
        //     'name'=>'required',
        //     'type_sensor_id'=>'required',
        //     'sector_id'=>'required',
        //     'enterprise_id'=>'required'
        // ]);

        $s->name = $request->input('name');
        $s->brand_freeze = $request->input('brand_freeze');
        $s->model_freeze = $request->input('model_freeze');
        $s->send_alert = $request->input('send_alert');
        $s->send_sms = $request->input('send_sms');
        $s->type_sensor_id = $request->input('type_sensor_id');
        $s->sector_id = $request->input('sector_id');
        $s->enterprise_id = $request->input('enterprise_id');

        if ($s->save()) {
            return redirect('/sensor')->with('success', 'Sensor Criado!');
        } else {
            return redirect('/sensor')->with('danger', 'Sensor não Criado!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $s = Sensor::find($id);

        if ($s->delete()) {
            return redirect('/sensor')->with('success', 'Sensor excluido!');
        } else {
            return redirect('/sensor')->with('danger', 'Erro ao exluir!');
        }

    }
}
