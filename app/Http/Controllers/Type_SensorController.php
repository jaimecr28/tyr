<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type_sensor;

class Type_SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $t = new Type_sensor;

        $t->name = $request->input('name');

        if ($t->save()) {
            return redirect('/')->with('success', 'Novo tipo criado com sucesso!');
        } else {
            return redirect('/')->with('danger', 'Não foi possivel criar novo tipo de sensor!');
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
        $t = Type_sensor::find($id);
        $t->name = $request->input('name');

        if ($t->save()) {
            return redirect('/')->with('success', 'Novo tipo criado com sucesso!');
        } else {
            return redirect('/')->with('danger', 'Não foi possivel criar novo tipo de sensor!');
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
        $t = Type_sensor::find($id);
        if ($t->delete()) {
            return redirect('/')->with('success', 'Tipo de sensor excluido!');
        } else {
            return redirect('/')->with('danger', 'Não foi possivel Excluir tipo de sensor!');
        }

    }
}
