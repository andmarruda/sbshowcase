@if($enabled)
    <button type="button" class="btn btn-outline-danger" onclick="javascript: confirmEnableDisable('{{$route}}', {{$id}}, '{{$token}}');"><i class="fa-solid fa-trash"></i> Desativar</button>
@else
    <button type="button" class="btn btn-outline-primary" onclick="javascript: confirmEnableDisable('{{$route}}', {{$id}}, '{{$token}}');"><i class="fa-solid fa-trash-arrow-up"></i> Ativar</button>
@endif