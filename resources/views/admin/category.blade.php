@extends('template.admin')

@section('page')
<form method="post" action="{{route('category.save')}}" autocomplete="off">
    <input type="hidden" name="id" id="id" value="{{$Category->id ?? ''}}">
    @csrf

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Produto</a></li>
            <li class="breadcrumb-item active" aria-current="page">Categoria</li>
        </ol>
    </nav>

    <div class="mb-3">
        <label for="category" class="form-label">Nome da categoria</label>
        <input type="text" minlength="3" maxlength="100" class="form-control" id="category" name="category" placeholder="Nome da categoria" required value="{{$Category->name ?? ''}}">
    </div>

    @include('template.includes.alert-error')

    @if(!is_null(session('saved')))
        @include('template.includes.alert-saved', ['success' => 'Categoria salva com sucesso!', 'error' => 'Erro ao salvar categoria!', 'saved' => session('saved')])
    @endif

    <div class="mb-3">
        @if(is_null($Category) || is_null($Category->deleted_at))
        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
        @endif

        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>

        @if(!is_null($Category))
        @include('template.includes.disable-enable', ['enabled' => is_null($Category->deleted_at), 'route' => route('category.delete'), 'id' => $Category->id, 'token' => csrf_token()])
        @endif
    </div>
</form>

@include('template.includes.search-modal', ['modalTitle' => 'Pesquisar categoria', 'placeholder' => 'Categoria', 'route' => route('category.search'), 'loadRoute' => route('category'), 'ths' => ['#', 'Categoria', 'Ativa?']])
@endsection