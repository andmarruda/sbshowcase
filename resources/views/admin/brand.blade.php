@extends('template.admin')

@section('page')
<form method="post" action="{{route('brand.save')}}" autocomplete="off">
    <input type="hidden" name="id" id="id" value="{{$Brand->id ?? ''}}">
    @csrf

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Produto</a></li>
            <li class="breadcrumb-item active" aria-current="page">Marca</li>
        </ol>
    </nav>

    <div class="mb-3">
        <label for="name" class="form-label">Nome da marca</label>
        <input type="text" minlength="2" maxlength="50" class="form-control" id="name" name="name" placeholder="Nome da marca" required value="{{$Brand->name ?? ''}}">
    </div>

    @include('template.includes.alert-error')

    @if(!is_null(session('saved')))
        @include('template.includes.alert-saved', ['success' => 'Marca salva com sucesso!', 'error' => 'Erro ao salvar marca!', 'saved' => session('saved')])
    @endif

    <div class="mb-3">
        @if(is_null($Brand) || is_null($Brand->deleted_at))
        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
        @endif

        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>

        @if(!is_null($Brand))
        @include('template.includes.disable-enable', ['enabled' => is_null($Brand->deleted_at), 'route' => route('brand.delete'), 'id' => $Brand->id, 'token' => csrf_token()])
        @endif
    </div>
</form>

@include('template.includes.search-modal', ['modalTitle' => 'Pesquisar marca', 'placeholder' => 'Marca', 'route' => route('brand.search'), 'loadRoute' => route('brand'), 'ths' => ['#', 'Marca', 'Ativa?']])
@endsection