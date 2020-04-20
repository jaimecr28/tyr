@extends('layouts.basic')

@section('content')
<style>
    .card-setor {
        border: solid 5px;
        height: 130px;
        border-radius: 30px;
        border-color: #27292C;
        background: #EE7422;
        color: #27292C;
        font: bolder;
    }
    .card{
        background-color: dimgray;
        color: aliceblue;
    }
    .card-active{
        background-color: black;
    }
    .esconde{
        display:none;
    }
</style>
<form id="formId" action="/plotsetor" method="POST">
    @csrf
    <input type="hidden" name="empresa_id" id="empresa_id">
    <input type="hidden" name="setor_id" id="setor_id">
    <div id="empresaDiv" class="row">
        <h2>Selecione a Empresa:</h2>
        @foreach ($enterprises as $enterprise)
        <div class="col-md-4">
            <a onclick="SelecionaEmpresa('{{$enterprise->id}}','{{$enterprise->name}}')" id="empresaBtn" href="#">
                <div class="card">
                    <h2 class="text-center"><i class="ti-shopping-cart"></i> {{$enterprise->name}}</h2><br>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <h1 id="empresa_nome" class="text-center"></h1>
    <h2 id="setor_nome" class="text-center"></h2>
    <div id="setorDiv" class="row esconde">

        <h2>Selecione o Setor:</h2>
        @foreach ($sectors as $sector)
        <div id="setor{{$sector->id}}" class="col-md-4">
            <a onclick="SelecionaSetor('{{$sector->id}}','{{$sector->name}}')" href="#">
                <div class="card">
                    <h2 class="text-center"><i class="ti-pie-chart"></i> {{$sector->name}}</h2><br>
                </div>
            </a>
        </div>
        @endforeach

    </div>
    <div id="btnContinuar" class="row esconde">
        <button class="btn btn-primary btn-block btn-lg" type="submit">Acompanhar Setor</button>
    </div>
</form>

@endsection
@section('javascript')
<script>
    var element = document.getElementById("live");
    element.classList.add("active");
    // var setorId = "";
    // var empresaId = "";

    function SelecionaEmpresa(id, empresa) {
        $("#setorDiv").toggleClass('esconde');
        $("#empresaDiv").toggleClass('esconde');
        $('#empresa_nome').append(empresa)

        $('#empresa_id').val(id);
    }

    function SelecionaSetor(id, setor) {
        // $("#setorDiv").toggleClass('esconde');
        // $("#empresaDiv").toggleClass('esconde');
        $("#setorDiv").toggleClass('esconde');

        $('#setor_id').val(id);
        $('#setor_nome').append(setor)
        $("#btnContinuar").toggleClass('esconde');


    }
</script>


@endsection