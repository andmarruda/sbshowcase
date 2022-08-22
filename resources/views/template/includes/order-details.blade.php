<div class="row" style="margin-top:2rem;">
    <div class="col-md-12">
        <h4>Seu pedido nº {{$Order->id}} foi realizado com sucesso.</h4>
        <p>Para acompanhar seu pedido acesse a área do cliente <a href="{{route('customer-login')}}" alt="Área do cliente" target="_blank">clicando aqui.</a></p>
        <p>Status do seu pedido: <strong>{{$Order->order_status()->first()->status}}</strong></p>
        <p>Em breve novos email informando o andamento do seu pedido serão enviados!</p>
    </div>
</div>

<div class="row" style="margin-top:2rem;">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Endereço de entrega / cobrança
            </div>
            <div class="card-body">
                <p class="mb-0"><b>Endereço:</b> {{$OrderAddress->address ?? ''}}, {{$OrderAddress->number ?? ''}} - {{$OrderAddress->neighborhood ?? ''}}</p>
                <p class="mb-0"><b>CEP:</b> {{$OrderAddress->zip_code ?? ''}}</p>
                <p class="mb-0"><b>Complemento:</b> {{$OrderAddress->complement ?? ''}}</p>
                <p class="mb-0"><b>Cidade:</b> {{$OrderAddress->city()->first()->city_name}} - {{$OrderAddress->state()->first()->state_initials}}</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Totais
            </div>
            <div class="card-body" style="text-align:right; font-size:20px;">
                <p><b>Subtotal: </b> R${{number_format($Order->subtotal, 2, ',', '.')}}</p>
                <p><b>Frete: </b> R${{number_format($Order->shippment_price, 2, ',', '.')}}</p>
                <p><b>Total: </b> R${{number_format($Order->total, 2, ',', '.')}}</p>
            </div>
        </div>
    </div>
</div>

<div class="row" style="margin-top:2rem;">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Produtos
            </div>
            <div class="card-body">
                @foreach($Products as $Product)
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{$Product->product()->first()->getImage()}}" srcset="{{$Product->product()->first()->getImgSrcSet()}}" sizes="{{$Product->product()->first()->getImgSizeSet()}}" class="img-fluid rounded-start" alt="{{$Product->product_name}}" style="width:100px;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5>{{$Product->product_name}}</h5>
                                    <div>
                                        <p class="price">Quantidade: {{$Product->quantity}}<br>Preço: R${{number_format(($Product->quantity * $Product->price), 2, ',', '.')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row" style="margin-top:2rem;">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Forma de pagamento
            </div>
            <div class="card-body">
                <div class="alert alert-info">Pagamento na entrega</div>
                <p>Pagamento através de {{$PaymentMethod->payment_method()->first()->name}} em {{$PaymentMethod->installments}}x de R${{number_format($PaymentMethod->installment_price, 2, ',', '.')}} sem juros</p>
            </div>
        </div>
    </div>
</div>