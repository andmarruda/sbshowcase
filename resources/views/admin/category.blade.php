@extends('template.admin')

@section('page')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Produto</a></li>
        <li class="breadcrumb-item active" aria-current="page">Categoria</li>
    </ol>
</nav>

<form method="post" action="" autocomplete="off">
    <input type="hidden" name="id" id="id" value="">
    @csrf

    <div class="mb-3">
        <label for="category" class="form-label">Nome da categoria</label>
        <input type="text" maxlength="100" class="form-control" id="category" name="category" placeholder="Nome da categoria" required value="">
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalSearchCategory">Pesquisar</button>
    </div>
</form>
@endsection