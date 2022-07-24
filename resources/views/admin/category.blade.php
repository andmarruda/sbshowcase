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
        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#searchModal">Pesquisar</button>
        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#disableModal">Desativar</button>
    </div>
</form>

@include('template.includes.search-modal', ['modalTitle' => 'Pesquisar categoria', 'placeholder' => 'Categoria', 'route' => route('category.search'), 'loadRoute' => route('category'), 'ths' => ['#', 'Categoria', 'Ativa?']])
@include('template.includes.disable-modal', ['modalTitle' => 'Desativar categoria', 'message' => 'Deseja desativar a categoria? Ao desativar todos os produtos dessa categoria não aparecerão mais na vitrine.', 'route' => route('category.delete'), 'id' => NULL])
@endsection