<section class="col-md-4">
    <div class="h-100 w-100">
        <div class="img-container">
            @if(strlen($srcset) > 0 && strlen($sizeset) > 0)
            <img src="{{$image}}" alt="{{$name}}" srcset="{{$srcset}}" sizes="{{$sizeset}}">
            @else
            <img src="{{$image}}" alt="{{$name}}">
            @endif
        </div>
        <div class="infos">
            <h2>{{$name}}</h2>
            <p>{{$description}}</p>
            <p>Observação: {{$additional_observations}}</p>
            @if(!empty($old_price))
            <p class="old-price">De: R${{number_format($old_price, 2, ',', '.')}}</p>
            @endif
            <p class="price">Por: R${{number_format($price, 2, ',', '.')}}</p>
            <small>Em até {{$installments_limit}}xR${{number_format(($price / $installments_limit), 2, ',', '.')}} sem juros no cartão de crédito</small>
        </div>

        <div class="action">
            <a href="{{route('product-detail', ['id' => $id, 'name' => str_replace(' ', '-', $name)])}}" role="button" class="btn btn-light">Saiba mais</a>
            <a href="#" role="button" class="btn" style="background-color: #{{$highlightbg}}; color: #{{$highlightcolor}}">+ Carrinho</a>
        </div>

        @if(($promotion_flag ?? false))
        <div class="free-shipping position-absolute top-0 rounded-pill w-75" role="alert" style="cursor: pointer; background-color: #{{$primarybg}}; color: #{{$primarycolor}};" data-bs-toggle="modal" data-bs-target="#eligible_delivery">
            <small>Frete grátis Elegível<br>
            Veja cidades com frete grátis</small>
        </div>
        @endif
    </div>
</section>