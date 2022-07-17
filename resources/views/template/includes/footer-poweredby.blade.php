<div class="row" style="margin-top: 1rem;">
    <div class="col-md-12">
        <div class="d-flex justify-content-between">
            <ul class="list-inline">
                @foreach($socialNetworks as $label => $sn)
                <li class="list-inline-item"><a href="{{$sn['url']}}" title="{{$label}}"><img src="{{$sn['img']}}" alt="{{$label}}" width="{{$sn['width']}}" height="{{$sn['height']}}"></a></li>
                @endforeach
            </ul>

            <ul class="list-inline">
                <li class="list-inline-item"><a href="void(0);" title="Nossas Lojas">Nossas Lojas</a></li>
                <li class="list-inline-item">|</li>
                <li class="list-inline-item"><a href="void(0);" title="Meus pedidos">Blog</a></li>
                <li class="list-inline-item">|</li>
                <li class="list-inline-item"><a href="void(0);" title="Meus pedidos">Mapa do site</a></li>
            </ul>

            <a href="https://sysborg.com.br" target="_blank"><img src="images/poweredby.png" alt="Powered by Sysborg"></a>
        </div>
    </div>
</div>