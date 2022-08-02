<div class="col-md-4 mt-4">
    <div class="card">
        <img src="{{asset('storage/'.$Product->image)}}" class="card-img-top" alt="{{$Product->name}}">
        <div class="card-body">
            @if(!is_null($Product->deleted_at))
            <div class="alert alert-danger" style="padding:2px;">Produto inativo</div>
            @endif
            <h5 class="card-title">{{$Product->name}}</h5>
            <p class="card-text">{!!substr($Product->description, 0, 200)!!}</p>
        </div>

        @php
            $measure_vals = $Product->measure()->first();
        @endphp

        <ul class="list-group list-group-flush">
            <li class="list-group-item">Vendas: Em construção</li>
            <li class="list-group-item">Categoria: {{$Product->category()->first()->name}}</li>
            <li class="list-group-item">Marca: {{$Product->brand()->first()->name}}</li>
            <li class="list-group-item">Medidas: {{$measure_vals->width}}x{{$measure_vals->length}}x{{$measure_vals->height}}</li>
            <li class="list-group-item">Tipo: {{$Product->type()->first()->name}}</li>
            <li class="list-group-item">Cor: {{$Product->color()->first()->name}}</li>
        </ul>
        <div class="card-body">
            <a href="{{route('product', ['id' => $Product->id])}}" role="button" class="btn btn-primary"><i class="fa-solid fa-file-pen"></i> Editar</a>
            <a href="{{route('product', ['id' => $Product->id, 'copy' => 1])}}" role="button" class="btn btn-outline-primary"><i class="fa-solid fa-copy"></i> Copiar</a>
            <a href="javascript: void(0);" onclick="javascript: disableProduct({{$Product->id}}, '', '{{csrf_token()}}')" role="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Desativar</a>
        </div>
    </div>
</div>