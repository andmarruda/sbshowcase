@extends('template.admin')

@section('page')
<form method="post" action="{{route('measurement.save')}}" autocomplete="off">
    <input type="hidden" name="id" id="id" value="{{$Delivery->id ?? ''}}">
    @csrf

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Configurações</a></li>
            <li class="breadcrumb-item active" aria-current="page">Entrega</li>
        </ol>
    </nav>

    <div class="mb-3">
        <label for="width" class="form-label">UF</label>
        <select class="form-controle" id="state_id" name="state_id">
            <option value="">Selecione...</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="height" class="form-label">Cidade</label>
        <select class="form-controle" id="city_id" name="city_id">
            <option value="">Selecione...</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Preço <small>em R$</small></label>
        <input type="number" required step="0.01" min="0" max="99999" class="form-control" id="price" name="price" placeholder="Preço" required value="">
    </div>

    @include('template.includes.alert-error')

    @if(!is_null(session('saved')))
        @include('template.includes.alert-saved', ['success' => 'Medida salva com sucesso!', 'error' => 'Erro ao salvar medida!', 'saved' => session('saved')])
    @endif

    <div class="mb-3">
        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
    </div>
</form>
@endsection