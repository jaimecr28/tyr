<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sector;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setores = Sector::all();

        return view('sector/list', compact('setores'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $s = new Sector;

        $s->name = $request->input('name');

        if ($s->save()) {
            return redirect('/setores')->with('success', 'Setor Cadastrado');
        }else {
            return redirect('/setores')->with('danger', 'Setor não Cadastrado');
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
        
    }
    public function showLiveSector($id)
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
        $setor = Sector::find($id);
        return view('sector.edit', compact('setor'));
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
        $s = Sector::find($id);
        $s->name = $request->input('name');

        if ($s->save()) {
            return redirect('/setores')->with('success', 'Setor Atualizado');
        }else {
            return redirect('/setores')->with('danger', 'Empresa não Atualizado');
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
        $s = Sector::find($id);

        if ($s->delete()) {
            return redirect('/setores')->with('success', 'Setor Excluido!');
        } else {
            return redirect('/setores')->with('danger', 'Setor não Excluido');
        }
        
        
    }
}
