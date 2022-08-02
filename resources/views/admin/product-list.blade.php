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
        <div class="col-md-4 mt-4">
            <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Produto</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">An item</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                </ul>
                <div class="card-body">
                    <a href="#" role="button" class="btn btn-outline-primary"><i class="fa-solid fa-file-pen"></i> Editar</a>
                    <a href="#" role="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Desativar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-4">
            <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Produto</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">An item</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                </ul>
                <div class="card-body">
                    <a href="#" role="button" class="btn btn-outline-primary"><i class="fa-solid fa-file-pen"></i> Editar</a>
                    <a href="#" role="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Desativar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-4">
            <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Produto</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">An item</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                </ul>
                <div class="card-body">
                    <a href="#" role="button" class="btn btn-outline-primary"><i class="fa-solid fa-file-pen"></i> Editar</a>
                    <a href="#" role="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Desativar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-4">
            <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Produto</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">An item</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                </ul>
                <div class="card-body">
                    <a href="#" role="button" class="btn btn-outline-primary"><i class="fa-solid fa-file-pen"></i> Editar</a>
                    <a href="#" role="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Desativar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-4">
            <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Produto</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">An item</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                </ul>
                <div class="card-body">
                    <a href="#" role="button" class="btn btn-outline-primary"><i class="fa-solid fa-file-pen"></i> Editar</a>
                    <a href="#" role="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Desativar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-4">
            <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Produto</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">An item</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                </ul>
                <div class="card-body">
                    <a href="#" role="button" class="btn btn-outline-primary"><i class="fa-solid fa-file-pen"></i> Editar</a>
                    <a href="#" role="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Desativar</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection