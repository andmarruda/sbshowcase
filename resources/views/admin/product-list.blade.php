@extends('template.admin')

@section('page')
<form method="get" action="{{route('product.search')}}" autocomplete="off">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Produto</a></li>
            <li class="breadcrumb-item active" aria-current="page">Listagem de produto</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col input-group">
            <input type="text" class="form-control" placeholder="Buscar produtos" name="search" id="search" value="{{$search ?? ''}}">
            <button class="btn btn-outline-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i> Buscar</button>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <div class="alert alert-info">Caso não utilize a pesquisa o sistema lista os produtos de modo decrescente baseado na data de registro!</div>
        </div>
    </div>

    <div class="row">
        @forelse($Products as $product)
            @include('admin.product-card', ['Product' => $product])
        @empty
        <div class="col-md-12">
            <div class="alert alert-warning">Nenhum produto encontrado!</div>
        </div>
        @endforelse
    </div>
</form>
@endsection