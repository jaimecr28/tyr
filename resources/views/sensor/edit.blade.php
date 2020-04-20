@extends('layouts.basic')
@section('tab', 'Sensores')
@section('content')
<div class="card text-white bg-success">

    <div class="card-body">


        <form action="{{ route('sensores.update', $sensor->id)}}" method="POST" id="formsensor">
            @method('PATCH')
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$sensor->name}}"
                            placeholder="" aria-describedby="helpId">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="brand_freeze">Marca da Geladeira</label>
                        <input type="text" name="brand_freeze" id="brand_freeze" class="form-control"
                            value="{{$sensor->brand_freeze}}" placeholder="" aria-describedby="helpId">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="model_freeze">Modelo da Geladeira</label>
                        <input type="text" name="model_freeze" id="model_freeze" class="form-control"
                            value="{{$sensor->model_freeze}}" placeholder="" aria-describedby="helpId">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="is_active">Ativo?</label>
                        <select type="text" name="is_active" id="is_active" class="form-control">
                            @if ($sensor->is_active)
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                            @else
                            <option value="0">Ativo</option>
                            <option value="1">Inativo</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="send_alert">Envio de alerta</label>
                        <select type="text" name="send_alert" id="send_alert" class="form-control">
                            @if ($sensor->send_alert)
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                            @else
                            <option value="0">Ativo</option>
                            <option value="1">Inativo</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="send_sms">Envio de SMS</label>
                        <select type="text" name="send_sms" id="send_sms" class="form-control">
                            @if ($sensor->send_sms)
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                            @else
                            <option value="0">Ativo</option>
                            <option value="1">Inativo</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Tipo de Sensor</label>
                        <select type="text" name="name" id="name" class="form-control">
                            <optgroup label="Ativa">
                                <option value="{{$sensor->type_sensor_id}}">{{$sensor->type_sensor->name}}:
                                    {{$sensor->type_sensor->min_temp}} até {{$sensor->type_sensor->max_temp}}</option>
                            </optgroup>
                            <optgroup label="Opções">
                                @foreach ($type_sensors as $type_sensor)
                                <option value="{{$type_sensor->id}}">{{$type_sensor->name}}: {{$type_sensor->min_temp}}
                                    até {{$type_sensor->max_temp}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Setor</label>
                        <select type="text" name="sector_id" id="sector_id" class="form-control">
                            <optgroup label="Ativa">
                                <option value="{{$sensor->sector_id}}">{{$sensor->sector->name}}</option>
                            </optgroup>
                            <optgroup label="Opções">
                                @foreach ($sectors as $sector)
                                <option value="{{$sector->id}}">{{$sector->name}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="enterprise_id">Empresa</label>
                        <select type="text" name="enterprise_id" id="enterprise_id" class="form-control">
                            <optgroup label="Ativa">
                                <option value="{{$sensor->enterprise_id}}">{{$sensor->enterprise->name}}</option>
                            </optgroup>
                            <optgroup label="Opções">
                                @foreach ($enterprises as $enterprise)
                                <option value="{{$enterprise->id}}">{{$enterprise->name}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-2 col-md-offset-8"><button class="btn btn-primary" type="submit">Atualizar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('javascript')

<script>
    var element = document.getElementById("sensores");
    element.classList.add("active");
</script>
@endsection