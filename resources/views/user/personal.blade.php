@extends('layouts.basic')

@section('content')
<form action="{{route('user.update')}}" method="post">
<div class="col-md-4 col-md-offset-4">
    <div class="card">
        <img class="card-img-top" src="holder.js/100x180/" alt="">
        <div class="card-body">
                <h4 class="card-title text-center">Atualizar Registro</h4>
                <div class="form-group">
                <input type="hidden" name="id" value="{{$u->id}}">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="" aria-describedby="helpId" value="{{$u->name}}">
                    <label for="email">E-mail</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="" aria-describedby="helpId" value="{{$u->email}}">
                    <label for="new_password">Nova Senha:</label>
                    <input type="password" name="new_password" id="new_password" class="form-control" placeholder=""
                        aria-describedby="helpId" >
                    <label for="confirm">Confirme Nova Senha:</label>
                    <input type="password" name="confirm" id="confirm" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
            
        </div>
        <button class="btn btn-default" type="submit">Salvar Alterações</button>
    </div>
</div>
</form>


@endsection

@section('javascript')

@endsection