@extends('layouts.basic')

@section('content')

<div class="row">
    @foreach ($sensors as $sensor)
    <div class="col-md-6">
        <div class="card border-secondary mb-3">
            <div class="card-header">
                <h2>{{$sensor->name}}</h2>
            </div>
            <div class="card-body text-secondary">
                <p class="text-danger"> {{$sensor->type_sensor->name}} - Temperatura
                    Máxima:{{$sensor->type_sensor->max_temp}}<code>&deg;</code>C
                    - Temperatura Minima:{{$sensor->type_sensor->min_temp}}<code>&deg;</code>C</p>
                <canvas id="graf{{$sensor->id}}"></canvas>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@section('javascript')
{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    var element = document.getElementById("live");
    element.classList.add("active");

    function formataData(dt){
        dth = new Date(dt);

        dia = dth.getDate();
        mes = dth.getMonth() + 1;
        ano = dth.getFullYear();
        hora = dth.getHours();
        minutos = dth.getMinutes();

        return dia + "/" + mes + "/" + ano + " " + hora + ":" + minutos;

    }
    function populaGrafico(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $.ajax({
            type: "GET",
            url: "/api/medidas/" + id,
            context: this,
            success: function (data) {
                dados = JSON.parse(data);
                labels = [];
                temperaturas = [];
                max_temp = [];
                min_temp = [];
                $.each(dados, function (key, dado) {
                    labels.push(formataData(dado['datetime']));
                    temperaturas.push(dado['temperature']);
                    max_temp.push(dado['sensor']['type_sensor']['max_temp']);
                    min_temp.push(dado['sensor']['type_sensor']['min_temp']);
                    console.log(dado['sensor']['type_sensor']['max_temp'])
                });
                //console.log(dados);
                drawChart(labels, temperaturas, id);

            },
            error: function (error) {

                
                console.log(error);
            }
        })
    }


    function drawChart(labels, temperaturas, id) {

        var divId = "";
        divId = 'graf' + id;
        var ctx = document.getElementById(divId).getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create

            type: 'line',

            // The data for our dataset
            data: {
                labels: labels,
                datasets: [{
                    label: 'Temperaturas',
                    pointRadius: '1',
                    //backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: '#031A23',
                    data: temperaturas,
                    borderWidth: 2
                }]
            },

            // Configuration options go here
            options: {
                annotation: {
                    annotations:[{
                        type:'line',
                        mode:'horizontal',
                        scaleID:'y-axis-0',
                        value:'6',
                        borderColor:'red',
                        borderWidth:'1'
                    }]
                }


            }
        });
    }
</script>
@foreach ($sensors as $sensor)
<script>
    populaGrafico('{{$sensor->id}}');
</script>

@endforeach
@endsection