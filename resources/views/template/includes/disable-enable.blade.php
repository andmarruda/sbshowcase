@if($enabled)
    <button type="button" class="btn btn-outline-danger" onclick="javascript: confirmEnableDisable('{{$route}}', {{$id}}, '{{$token}}');">Desativar</button>
@else
    <button type="button" class="btn btn-outline-primary" onclick="javascript: confirmEnableDisable('{{$route}}', {{$id}}, '{{$token}}');">Ativar</button>
@endif