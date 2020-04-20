@extends('layouts.basic')
@section('tab', 'Sensores')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<div class="card text-white bg-light">
    <div class="card-body">

        <table id="tabelasensores" class="table table-hover table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th></th>
                    <th>Identificação</th>
                    <th>Setor</th>
                    <th>Empresa</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Temperatura Máxima</th>
                    <th>Temperatura Mínima</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sensores as $sensor)
                <tr>
                    <td>{{$sensor->id}}</td>
                    <td>{{$sensor->name}}</td>
                    <td>{{$sensor->sector->name}}</td>
                    <td>{{$sensor->enterprise->name}}</td>
                    <td>{{$sensor->brand_freeze}}</td>
                    <td>{{$sensor->model_freeze}}</td>
                    <td>{{$sensor->type_sensor->max_temp}}</td>
                    <td>{{$sensor->type_sensor->min_temp}}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a class="btn btn-default" href="/sensores/{{$sensor->id}}/edit"><i
                                    class="ti-pencil"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="col-md-offset-9 col-md-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sensormodal">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</div>

@endsection
@section('modal')


<!-- Modal -->
<div class="modal fade" id="sensormodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Body
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('javascript')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script>
    var element = document.getElementById("sensores");
    element.classList.add("active");

    //datatable
    $(document).ready(function () {
        $('#tabelasensores').DataTable({
            responsive: true,
            language: {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }


            }
        });
    });
</script>
@endsection