@extends('layouts.basic')
@section('tab', 'Setores')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

<table class="table table-striped table-responsive" id="tabelasetores">
    <thead class="thead-inverse">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($setores as $s)
        <tr>
            <td>{{$s->id}}</td>
            <td>{{$s->name}}</td>
            <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <form action="{{route('setores.destroy',$s->id)}}" method="post">
                        <a class="btn btn-default" href="/setores/{{$s->id}}/edit"><i class="ti-pencil"></i></a>

                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger delete" type="submit"><i class="ti-trash"></i></button>
                    </form>
                </div>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>
<div class="col-md-offset-9 col-md-3">
    <button class="btn btn-sm -btn-primary" data-toggle="modal" data-target="#cadastroSetor"><i class="fa fa-plus"
            aria-hidden="true"></i></button>

</div>
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade " id="cadastroSetor" tabindex="-1" role="dialog" aria-labelledby="cadastroSetorLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cadastro</h4>
            </div>
            <div class="modal-body">
                <form action="/setores" method="POST" id="formEmpresa">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="name">Nome:</label>
                                <input class="form-control" name="name" id="name">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-icon" data-dismiss="modal"><i class="ti-close"></i></button>
                        <button type="submit" class="btn btn-primary"><i class="ti-save"></i> Salvar Alterações</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection



@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.2.3/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script>
    //ativar barra lateral
    var element = document.getElementById("setores");
    element.classList.add("active");

    //SweetAlert2
    $(document).ready(function () {
        $(".delete").click(function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Você tem certeza?',
                text: "O item será excluído permanentemente!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, pode deletar!'
            }).then((result) => {
                if (result.value) {
                    Swal.fire(
                        'Excluído!',
                        'O item foi excluído com sucesso',
                        'success'
                    )
                    $(this).closest('form').submit();
                }
            })
        })
    })
    //datatable
    $(document).ready(function() {
    $('#tabelasetores').DataTable({
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
} );
</script>

@endsection