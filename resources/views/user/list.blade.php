@extends('layouts.basic')
@section('tab', 'Usuários')
@section('content')
<div class="card text-white bg-primary">
  <div class="card-body">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Usuário</th>
                <th>E-mail</th>
                <th>Permissão</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->is_permission}}</td>
            </tr>    
            @endforeach
            
        </tbody>
    </table>
    <hr>
  </div>
</div>
@endsection
@section('javascript')
    <script>
        var element = document.getElementById("usuarios");
        element.classList.add("active");
    
    </script>
@endsection