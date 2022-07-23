@extends('template.admin')

@section('page')
<form method="post" action="{{route('category.save')}}" autocomplete="off">
    <input type="hidden" name="id" id="id" value="">
    @csrf

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Produto</a></li>
            <li class="breadcrumb-item active" aria-current="page">Categoria</li>
        </ol>
    </nav>

    <div class="mb-3">
        <label for="category" class="form-label">Nome da categoria</label>
        <input type="text" maxlength="100" class="form-control" id="category" name="category" placeholder="Nome da categoria" required value="">
    </div>

    @include('template.includes.alert-error')

    <div class="mb-3">
        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalSearchCategory">Pesquisar</button>
        <button type="button" class="btn btn-outline-danger">Desativar</button>
    </div>
</form>
@endsection