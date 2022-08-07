<section class="col-md-4">
    <img src="{{$image}}" alt="{{$name}}" srcset="{{$srcset}}">
    <div class="infos">
        <h2>{{$name}}</h2>
        <p>{{$description}}</p>
        @if(!empty($old_price))
        <p class="old-price">De: R${{number_format($old_price, 2, ',', '.')}}</p>
        @endif
        <p class="price">Por: R${{number_format($price, 2, ',', '.')}}</p>
        <small>Em até {{$installments_limit}}xR${{number_format(($price / $installments_limit), 2, ',', '.')}} sem juros no cartão de crédito</small>
    </div>

    <div class="action">
        <a href="#" role="button" class="btn btn-light">Saiba mais</a>
        <a href="#" role="button" class="btn" style="background-color: #665132; color:#fff;">+ Carrinho</a>
    </div>
</section>