<section class="col-md-4">
    <div class="h-100 w-100">
        @if(!is_null($product))

        @php
            $sizeset = $product->getImgSizeSet();
            $srcset = $product->getImgSrcSet();
        @endphp

        <div class="img-container">
            @if(strlen($srcset) > 0 && strlen($sizeset) > 0)
            <img src="{{asset($product->getImage())}}" alt="{{$product->name}}" srcset="{{$srcset}}" sizes="{{$sizeset}}">
            @else
            <img src="{{asset($product->getImage())}}" alt="{{$product->name}}">
            @endif
        </div>
        <div class="infos">
            <h2>{{$product->name}}</h2>
            <p>{{$product->name}}</p>
            <p>Observação: {{$product->additional_observations}}</p>
            @if(!empty($product->old_price))
            <p class="old-price">De: R${{number_format($product->old_price, 2, ',', '.')}}</p>
            @endif
            <p class="price">Por: R${{number_format($product->price, 2, ',', '.')}}</p>
            <small>Em até {{$product->installments_limit}}xR${{number_format(($product->price / $product->installments_limit), 2, ',', '.')}} sem juros no cartão de crédito</small>
        </div>

        <div class="action">
            <a href="{{route('product-detail', ['id' => $product->id, 'name' => str_replace(' ', '-', $product->name)])}}" role="button" class="btn btn-light">Saiba mais</a>
            @if($product->quantity > 0)
            <a href="{{route('cart-add', ['product_id' => $product->id])}}" role="button" class="btn" style="background-color: #{{$template['templates']->highlightbg}}; color: #{{$template['templates']->highlightcolor}}">+ Carrinho</a>
            @else
            <a href="javascript: void(0);" role="button" class="btn" style="background-color: #{{$template['templates']->highlightbg}}; color: #{{$template['templates']->highlightcolor}}">Indisponível</a>
            @endif
        </div>

        @if(($promotion_flag ?? false))
        <div class="free-shipping position-absolute top-0 rounded-pill w-75" role="alert" style="cursor: pointer; background-color: #{{$template['templates']->primarybg}}; color: #{{$template['templates']->primarycolor}};" data-bs-toggle="modal" data-bs-target="#eligible_delivery">
            <small>Frete grátis Elegível<br>
            Veja cidades com frete grátis</small>
        </div>
        @endif

        @endif
    </div>
</section>