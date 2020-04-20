@extends('layouts.basic')
@section('tab', 'Empresas')
@section('content')
<form action="{{ route('empresas.update', $empresa->id)}}" method="POST" id="formEmpresa">
    @method('PATCH')
    @csrf
    <input type="hidden" id="id" class="form-control">
    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
                <label for="name">Nome:</label>
            <input class="form-control" name="name" id="name" value="{{$empresa->name}}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="is_parent">Status</label>
                <select class="form-control" name="is_parent" id="is_parent">
                    <option value="1">Matriz</option>
                    <option value="0">Filial</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="cnpj">CNPJ</label>
                <input type="text" name="cnpj" id="cnpj" class="form-control cnpj" placeholder="" aria-describedby="helpId" value="{{$empresa->cnpj}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="phone">Telefone</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="" aria-describedby="helpId" value="{{$empresa->phone}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="adress_cep">CEP</label>
                <input type="text" name="adress_cep" id="adress_cep" class="form-control" placeholder=""
                    aria-describedby="helpId"  value="{{$empresa->adress_cep}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="adress_city">Cidade</label>
                <input type="text" name="adress_city" id="adress_city" class="form-control" placeholder=""
                    aria-describedby="helpId"  value="{{$empresa->adress_city}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="adress_uf">UF</label>
                <select class="form-control" name="adress_uf" id="adress_uf"  value="{{$empresa->adress_uf}}">
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
                <input type="text" name="adress" id="adress" class="form-control" placeholder="" value="{{$empresa->adress}}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="adress_number">Número e/ou Complemento</label>
                <input type="text" name="adress_number" id="adress_number" class="form-control" placeholder=""
                    aria-describedby="helpId" value="{{$empresa->adress_number}}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="adress_district">Bairro</label>
                <input type="text" name="adress_district" id="adress_district" class="form-control" placeholder=""
                    aria-describedby="helpId" value="{{$empresa->adress_district}}">
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary"><i class="ti-save"></i> Salvar Alterações</button>
</form>

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.min.js"></script>
<script>
      $("#formEmpresa").validate(
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
</script>
<script src="{{asset('js/jquery.mask.js')}}"></script>
<script>
    //mascaras
    $('.cnpj').mask('00.000.000/0000-00', {
        reverse: true
    });
    //ativar barra lateral
    var element = document.getElementById("empresas");
    element.classList.add("active");
</script>

@endsection