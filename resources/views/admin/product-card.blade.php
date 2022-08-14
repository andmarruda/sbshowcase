<div class="col-md-4 mt-4">
    <div class="card">
        <div class="img-container">
            <img src="{{asset('storage/'.$Product->image)}}" class="card-img-top" alt="{{$Product->name}}">
        </div>
        
        <div class="card-body">
            @if(!is_null($Product->deleted_at))
            <div class="alert alert-danger" style="padding:2px;">Produto inativo</div>
            @endif
            <h5 class="card-title">{{$Product->name}}</h5>
            <p class="card-text">{!! strip_tags(substr($Product->description, 0, 200)) !!}</p>
            <p class="card-text">Observação: {{$Product->additional_observations}}</p>
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
            <a href="javascript: void(0);" onclick="javascript: confirmEnableDisable('{{route('product.delete')}}', {{$Product->id}}, '{{csrf_token()}}')" role="button" class="{{is_null($Product->deleted_at) ? 'btn btn-outline-danger' : 'btn btn-outline-primary'}}"><i class="fa-solid {{is_null($Product->deleted_at) ? 'fa-trash' : 'fa-trash-arrow-up'}}"></i> {{is_null($Product->deleted_at) ? 'Desativar' : 'Ativar'}}</a>
        </div>
    </div>
</div>