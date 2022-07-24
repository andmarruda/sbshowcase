@extends('template.admin')

@section('page')
<form method="post" action="{{route('measurement.save')}}" autocomplete="off">
    <input type="hidden" name="id" id="id" value="{{$Category->id ?? ''}}">
    @csrf

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Produto</a></li>
            <li class="breadcrumb-item active" aria-current="page">Medidas</li>
        </ol>
    </nav>

    <div class="mb-3">
        <label for="width" class="form-label">Largura <small>em cm</small></label>
        <input type="number" required step="1" maxlength="15" class="form-control" id="width" name="width" placeholder="Largura" required value="{{$Measurement->width ?? ''}}">
    </div>

    <div class="mb-3">
        <label for="height" class="form-label">Altura <small>em cm</small></label>
        <input type="number" required step="1" maxlength="15" class="form-control" id="height" name="height" placeholder="Altura" required value="{{$Measurement->height ?? ''}}">
    </div>

    <div class="mb-3">
        <label for="length" class="form-label">Comprimento <small>em cm</small></label>
        <input type="number" required step="1" maxlength="15" class="form-control" id="length" name="length" placeholder="Comprimento" required value="{{$Measurement->length ?? ''}}">
    </div>

    @include('template.includes.alert-error')

    @if(!is_null(session('saved')))
        @include('template.includes.alert-saved', ['success' => 'Categoria salva com sucesso!', 'error' => 'Erro ao salvar categoria!', 'saved' => session('saved')])
    @endif

    <div class="mb-3">
        @if(is_null($Measurement) || is_null($Measurement->deleted_at))
        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
        @endif

        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#searchModal">Pesquisar</button>

        @if(!is_null($Measurement))
        @include('template.includes.disable-enable', ['enabled' => is_null($Measurement->deleted_at), 'route' => route('measurement.delete'), 'id' => $Measurement->id, 'token' => csrf_token()])
        @endif
    </div>
</form>

@include('template.includes.search-modal', ['modalTitle' => 'Pesquisar categoria', 'placeholder' => 'Categoria', 'route' => route('category.search'), 'loadRoute' => route('category'), 'ths' => ['#', 'Categoria', 'Ativa?']])
@endsection