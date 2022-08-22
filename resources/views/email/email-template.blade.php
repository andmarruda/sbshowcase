<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Pedido realizado - Biosono Colchões</title>
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    </head>
    <body>
        <div class="container-lg" style="margin-top:0.5rem;">
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

            @yield('email')
        </div>
    </body>
</html>