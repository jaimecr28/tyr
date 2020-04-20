@extends('layouts.basic')

@section('tab', 'Status')
@section('content')
<link href="{{asset('css/classic.css')}}" rel="stylesheet" />
<link href="{{asset('css/classic.date.css')}}" rel="stylesheet" />
<link href="{{asset('css/classic.time.css')}}" rel="stylesheet" />
<div class="card border-primary">
    @if (count($w)>0)
        
    
    <div class="card-body">
        <table class="table table-striped table-bordered" id="tabelaAlerta">
            <thead>
                <tr>
                    <th></th>
                    <th>Alerta</th>
                    <th>Temperatura</th>
                    <th>Data da Medida</th>
                    <th>Sensor</th>
                    <th>Sector</th>
                    <th>Empresa</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($w as $i)
                <tr>
                    <td><input type="checkbox" class="form-control" name="selecao{{$i->id}}" value="{{$i->id}}"></td>
                    <td>{{$i->motive}}</td>
                    <td>{{$i->measurement->temperature}}°C</td>
                    <td>{{$i->measurement->datetime}}</td>
                    <td>{{$i->measurement->sensor->name}}</td>
                    <td>{{$i->measurement->sensor->sector->name}}</td>
                    <td>{{$i->measurement->sensor->enterprise->name}}</td>
                    
                </tr>
                @endforeach

            </tbody>
        </table>
        <div class="col-md-offset-9 col-md-3">
            <button class="btn btn-lg -btn-primary" data-toggle="modal" data-target="#justificativa" >Justificar</button>
        </div>

    </div>
    @else 

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-3">Sem alertas pendentes de justificativas!   <i class="ti-face-smile"></i></h1>
            <p class="lead">Fique sempre atento aos seus alertas</p>
            <hr class="my-2">
            <p>Confira os últimos alertas justificados:</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="Jumbo action link" role="button">Conferir</a>
            </p>
        </div>
    </div>
    @endif
</div>

@endsection
@section('modal')
            <div class="modal fade " id="justificativa" tabindex="-1" role="dialog" aria-labelledby="justificativaLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Justificando</h4>
                    </div>
                    <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Justificativa:</label>
                                        <textarea class="form-control" name="justifica" id="justifica" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                               

                            </div>
                            <div class="row">
                                 <div class="col-md-6">
                                    <label for="started_at">Data Inicial:</label>
                                    <input class="form-control" type="date" name="started_at" id="started_at">
                                </div>
                                <div class="col-md-6">
                                    <label for="started_time">Horário Inicial:</label>
                                    <input class="form-control" type="time" name="started_time" id="started_time">
                                </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-6">
                                    <label for="end_at">Data Final:</label>
                                    <input class="form-control" type="date" name="end_at" id="end_at">
                                </div>
                                <div class="col-md-6">
                                    <label for="end_time">Horário Final:</label>
                                    <input class="form-control" type="time" name="end_time" id="end_time">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-icon" data-dismiss="modal"><i class="ti-close"></i></button>
                                <button type="button" class="btn btn-primary" onclick="justificar()"><i class="ti-pencil"></i> Justificar Seleção</button>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('javascript')

<script>
    function formataData(dt){
        dth = new Date(dt);

        dia = dth.getDate();
        mes = dth.getMonth() + 1;
        ano = dth.getFullYear();
        hora = dth.getHours();
        minutos = dth.getMinutes();

        return dia + "/" + mes + "/" + ano + " " + hora + ":" + minutos;

    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });
    function justificar(){

        n_ids = [];
        ids = $('input:checked');

        for (let index = 0; index < ids.length; index++) {
            n_ids[index] = ids[index].value;
        }
        let ids_string = n_ids.join();
        j = {
            ids: ids_string,
            justifica: $('#justifica').val(),
            started_at: $('#started_at').val(),
            end_at: $('#end_at').val(),
            end_time: $('#end_time').val(),
            started_time: $('#started_time').val(),
        }
        $.ajax({
            type: "POST",
            url: "/api/justificar",
            context: this,
            data:j,
            success:function(data){
                console.log('Update OK');
                location.reload(true);
                },
            error: function(error){
                console.log(error);
            }
                

        })
        

    }
    var element = document.getElementById("status");
    element.classList.add("active");

</script>
@endsection