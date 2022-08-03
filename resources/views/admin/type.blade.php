@extends('template.admin')

@section('page')
<form method="post" action="{{route('type.save')}}" autocomplete="off">
    <input type="hidden" name="id" id="id" value="{{$Type->id ?? ''}}">
    @csrf

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Produto</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tipos</li>
        </ol>
    </nav>

    <div class="mb-3">
        <label for="name" class="form-label">Nome do tipo</label>
        <input type="text" minlength="3" maxlength="50" class="form-control" id="name" name="name" placeholder="Nome do tipo" required value="{{$Type->name ?? ''}}">
    </div>

    @include('template.includes.alert-error')

    @if(!is_null(session('saved')))
        @include('template.includes.alert-saved', ['success' => 'Tipo salvo com sucesso!', 'error' => 'Erro ao salvar tipo!', 'saved' => session('saved')])
    @endif

    <div class="mb-3">
        @if(is_null($Type) || is_null($Type->deleted_at))
        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
        @endif

        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>

        @if(!is_null($Type))
        @include('template.includes.disable-enable', ['enabled' => is_null($Type->deleted_at), 'route' => route('type.delete'), 'id' => $Type->id, 'token' => csrf_token()])
        @endif
    </div>
</form>

@include('template.includes.search-modal', ['modalTitle' => 'Pesquisar tipo', 'placeholder' => 'Tipo', 'route' => route('type.search'), 'loadRoute' => route('type'), 'ths' => ['#', 'Tipo', 'Ativa?']])
@endsection