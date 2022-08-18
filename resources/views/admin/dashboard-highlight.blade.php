<div class="card">
    <div class="card-body">
    @if(is_null($product))
        <h5 class="card-title">Nenhum produto selecionado</h5>
    @else
        <img src="{{asset($product->getImage())}}" class="card-img-top" alt="{{$product->name}}">
        <h5 class="card-title">{{$product->name}}</h5>
    @endif
        <a href="javascript: void(0);" onclick="javascript: highlight_choosed(event);" data-bs-toggle="modal" data-bs-target="#dashboard-product" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</a>
    </div>
</div>