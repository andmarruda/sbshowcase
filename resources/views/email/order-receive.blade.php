<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Pedido realizado - Biosono Colchões</title>
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    </head>
    <body>
        <div class="container-lg">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{route('main')}}" title="{{$template['general']->brand}}">
                        <img src="{{asset($template['general']->getBrandImage())}}" alt="{{$template['general']->brand}}">
                    </a>
                </div>

                <div class="col-md-6">
                    <ul class="list-inline">
                        @foreach($template['SocialMedia'] as $label => $sn)
                        <li class="list-inline-item"><a href="{{$sn->url}}" title="{{$sn->socialMedia()->first()->name}}" target="_blank"><img src="{{asset($sn->socialMedia()->first()->icon)}}" alt="{{$sn->socialMedia()->first()->name}}" style="width:20px; height:20px;"></a></li>
                        @endforeach
                        @if(!is_null($template['general']->whatsapp_number))
                        <li class="list-inline-item"><a href="tel:{{$template['general']->whatsapp_number}}" title="Whatsapp"><img src="{{asset('images/icon-zap.png')}}" alt="Whatsapp" style="width:20px; height:20px;"></a></li>
                        <li class="list-inline-item" id="store-phone-number">{{$template['general']->whatsapp_number}}</li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="row" style="margin-top:2rem;">
                <div class="col-md-12">
                    <h4>Seu pedido nº {{$Order->id}} foi realizado com sucesso.</h4>
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
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>