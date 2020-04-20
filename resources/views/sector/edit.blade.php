@extends('layouts.basic')
@section('tab', 'Setores')
@section('content')
<form action="{{ route('setores.update', $setor->id)}}" method="POST" id="formsetor">
    @method('PATCH')
    @csrf
    <input type="hidden" id="id" class="form-control">
    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
                <label for="name">Nome:</label>
            <input class="form-control" name="name" id="name" value="{{$setor->name}}">
            </div>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary"><i class="ti-save"></i> Salvar Alterações</button>
</form>

@endsection

@section('javascript')
<script>
    var element = document.getElementById("setores");
    element.classList.add("active");
</script>

@endsection