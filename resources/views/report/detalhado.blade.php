@extends('layouts.basic')
@section('tab', 'Relatórios')

@section('content')
<form action="/detalhado" id="formReport">
<div class="card text-white bg-primary">
    <div class="card-body">
        <h2 class="card-title">Relatório Detalhado:</h2>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="empresa_select">Empresa:</label>
                    <select class="form-control" name="empresa_select" id="empresa_select">
                        @foreach ($empresas as $empresa)
                        <option value="{{$empresa->id}}">{{$empresa->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="setor_select">Setor:</label>
                    <select class="form-control" name="setor_select" id="setor_select">
                        <option value="0">Selecione o setor</option>
                        @foreach ($setores as $setor)
                        <option value="{{$setor->id}}">{{$setor->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="sensor_select">Sensor:</label>
                    <select class="form-control" name="sensor_select" id="sensor_select">

                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="periodo_mes">Mês:</label>
                    <select class="form-control" name="periodo_mes" id="periodo_mes">
                        	<option value="01">Janeiro</option>
                            <option value="02">Fevereiro</option>
                            <option value="03">Março</option>
                            <option value="04">Abril</option>
                            <option value="05">Maio</option>
                            <option value="06">Junho</option>
                            <option value="07">Julho</option>
                            <option value="08">Agosto</option>
                            <option value="09">Setembro</option>
                            <option value="10">Outubro</option>
                            <option value="11">Novembro</option>
                            <option value="12">Dezembro</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="periodo_ano">Ano:</label>
                    <select class="form-control" name="periodo_ano" id="periodo_ano">

                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="tipo_relatorio">Tipo de Relatório:</label>
                    <select class="form-control" name="tipo_relatorio" id="tipo_relatorio">
                        <option value="1">Relatório Detalhado</option>
                        <option value="2">Padrão Anvisa</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-9 col-md-3">
                <button class="btn btn-primary" type="submit">Gerar Relatório</button>
            </div>
            <br><hr>
        </div>

    </div>
</div>
</form>
@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.min.js"></script>
<script>
      $("#formReport").validate(
    {
      rules:{
        sensor_select: {
          required: true
        },
      },
      messages:{
        sensor_select: {
          required: "<p class='text-danger'> Selecione o Sensor</p>",
        },
      }
    }
  );
    var element = document.getElementById("report");
    element.classList.add("active");

    function populaAnos(){
        agora = new Date();

        for (let index = 0; index < 4; index++) {
            ano = agora.getFullYear() - index;

            $('#periodo_ano').append(
                '<option value="'+ano+'">'+ano+'</option>'
            )

        }
    }

    function removeAllOptions(){
        var select = document.getElementById("sensor_select");
        select.options.length = 0;
    }
    function populaSensor(empresa_id,sector_id){
        if (empresa_id != 0 & sector_id != 0 ) {
            $.ajax({
                type: "GET",
                url: "/api/sensores/" + empresa_id + "/" + sector_id,
                context: this,
                success: function (data) {
                    dados = JSON.parse(data);
                    $.each(dados, function (key, dado) {


                        $('#sensor_select').append('<option value="'+dado['id']+'">'+dado['name']+'</option>');
                    });

                },
                error: function (error) {


                    console.log(error);
                }
            })
        } else {
            console.log('Escolha a empresa e o setor');
        }

    }
$(document).ready(function(){
    populaAnos();
    $('#setor_select').on('change',function(){

        removeAllOptions();

        e_id = $('#empresa_select').val();
        s_id = $('#setor_select').val();
        populaSensor(e_id, s_id);

    });
    $('#empresa_select').on('change',function(){

        removeAllOptions();

        e_id = $('#empresa_select').val();
        s_id = $('#setor_select').val();
        populaSensor(e_id, s_id);

    });

});


</script>
@endsection
