<div class="row" style="margin-top: 1rem;">
    <div class="col-md-12">
        <div class="d-flex justify-content-between">
            <p></p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="{{route('our-stores')}}" title="{{__('sbshowcase.our.stores')}}">{{__('sbshowcase.our.stores')}}</a></li>
                @if(!is_null($blog))
                <li class="list-inline-item">|</li>
                <li class="list-inline-item"><a href="{{$blog}}" title="Blog" target="_blank">Blog</a></li>
                @endif
                @if(!is_null($sitemap))
                <li class="list-inline-item">|</li>
                <li class="list-inline-item"><a href="{{$sitemap}}" title="Mapa do site">Mapa do site</a></li>
                @endif
            </ul>

            <a href="https://sysborg.com.br" target="_blank"><img src="images/poweredby.png" alt="Powered by Sysborg"></a>
        </div>
    </div>
</div>