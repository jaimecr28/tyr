<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use App\Enterprise;

class EnterpriseController extends Controller
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
    public function index()
    {
        $empresas = Enterprise::all();
        return view('enterprise.list', compact('empresas'));
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

        $request->validate([
            'name'=>'required',
    
        ]);
        $e = new Enterprise();

        $e->name = $request->input('name');
        $e->is_parent = $request->input('is_parent');
        $e->cnpj = $request->input('cnpj');
        $e->adress = $request->input('adress');
        $e->adress_number = $request->input('adress_number');
        $e->adress_cep = $request->input('adress_cep');
        $e->adress_uf = $request->input('adress_uf');
        $e->adress_city = $request->input('adress_city');
        $e->adress_district = $request->input('adress_district');
        $e->phone = $request->input('phone');
        if ($e->save()) {
            return redirect('/empresas')->with('success', 'Empresa Cadastrada');
        }else {
            return redirect('/empresas')->with('danger', 'Empresa não Cadastrada');
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
        $empresa = Enterprise::find($id);
        return view('enterprise.edit', compact('empresa'));
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
        $request->validate([
            
            'name'=>'required',
        ]);

        $e = Enterprise::find($id);
        $e->name = $request->input('name');
        $e->is_parent = $request->input('is_parent');
        $e->cnpj = $request->input('cnpj');
        $e->adress = $request->input('adress');
        $e->adress_number = $request->input('adress_number');
        $e->adress_cep = $request->input('adress_cep');
        $e->adress_uf = $request->input('adress_uf');
        $e->adress_city = $request->input('adress_city');
        $e->adress_district = $request->input('adress_district');
        $e->phone = $request->input('phone');

        if ($e->save()) {
            return redirect('/empresas')->with('success', 'Empresa Atualizada');
        }else {
            return redirect('/empresas')->with('danger', 'Empresa não Atualizada');
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
        $e = Enterprise::find($id);
        if ($e->delete()) {
            return redirect('/empresas')->with('danger', 'Empresa Excluida');
        } else {
            return redirect('/empresas')->with('danger', 'Erro ao Excluir');
        }
        
        
    }
}
