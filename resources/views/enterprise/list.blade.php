@extends('layouts.basic')
@section('tab', 'Empresas')
@section('content')
<table class="table table-striped table-responsive" id="tabelaEmpresas">
    <thead class="thead-inverse">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($empresas as $e)
        <tr>
        <td>{{$e->id}}</td>
        <td>{{$e->name}}</td>
        <td>
            <div class="btn-group" role="group" aria-label="Basic example">
                <form action="{{route('empresas.destroy',$e->id)}}" method="post">
                <a class="btn btn-default" href="/empresas/{{$e->id}}/edit"><i class="ti-pencil"></i></a>
               
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
    <button class="btn btn-sm -btn-primary" data-toggle="modal" data-target="#cadastroEmpresa"><i class="fa fa-plus"
            aria-hidden="true"></i></button>
 
</div>
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade " id="cadastroEmpresa" tabindex="-1" role="dialog" aria-labelledby="cadastroEmpresaLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cadastro</h4>
            </div>
            <div class="modal-body">
                <form action="/empresas" method="POST" id="formEmpresa">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="name">Nome:</label>
                                <input class="form-control" name="name" id="name">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="is_parent">Tipo:</label>
                            <select name="is_parent" id="is_parent" class="form-control">
                                <option value="1">Matriz</option>
                                <option value="0">Filial</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cnpj">CNPJ</label>
                                <input type="text" name="cnpj" id="cnpj" class="form-control cnpj" placeholder=""
                                    aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">Telefone</label>
                                <input type="text" name="phone" id="phone" class="form-control phone" placeholder="" aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="adress_cep">CEP</label>
                                <input type="text" name="adress_cep" id="adress_cep" class="form-control cep" placeholder="" aria-describedby="helpId">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="adress_city">Cidade</label>
                                <input type="text" name="adress_city" id="adress_city" class="form-control" placeholder="" aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="adress_uf">UF</label>
                                <select class="form-control" name="adress_uf" id="adress_uf">
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="ES">Espírito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranhão</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Paraíba</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>
                                    <option value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="adress">Endereço</label>
                                <input type="text" name="adress" id="adress" class="form-control cnpj" placeholder="" aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="adress_number">Número e/ou Complemento</label>
                                <input type="text" name="adress_number" id="adress_number" class="form-control" placeholder="" aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="adress_district">Bairro</label>
                                <input type="text" name="adress_district" id="adress_district" class="form-control" placeholder="" aria-describedby="helpId">
                            </div>
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
<script src="{{asset('js/jquery.mask.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.2.3/dist/sweetalert2.all.min.js"></script>
<script>
    //mascaras
    $('.cnpj').mask('00.000.000/0000-00', {
        reverse: true
    });
    $('.cep').mask('00000-000', {
        reverse: true
    });
    // $('.phone').mask('(00)0000-0000', {
    //     reverse: true
    // });
    //ativar barra lateral
    var element = document.getElementById("empresas");
    element.classList.add("active");

        $(document).ready(function () {
        $(".delete").click(function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    $(this).closest('form').submit();
                }
            })
        })
    })
    
</script>

@endsection